<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;


class VineyardController extends Controller
{
    // Home routes
    public function featuredFrontend()
    {
        $featuredProducts = Product::inRandomOrder()->take(4)->get();
        return view('frontend.index', compact('featuredProducts'));
    }

    // Shop routes
    public function indexFrontend()
    {
        $products = Product::with('category')->paginate(8);
        return view('frontend.shop.shoplist', compact('products'));
    }

    public function showFrontend($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('frontend.shop.shopdetail', compact('product'));
    }

    // Cart routes
    public function cartIndex()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.shop.cart', compact('cartItems'));
    }

    public function cartAdd(Product $product)
    {
        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('vineyard.cart');
    }

    public function cartUpdate(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->route('vineyard.cart');
    }

    public function cartRemove(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('vineyard.cart');
    }

    // Order routes
    // Checkout route
    public function checkout(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.shop.checkout', compact('cartItems'));
    }

    // Prepare payment and redirect to Mollie
    public function preparePayment()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // Attach products to the order
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product_id, ['quantity' => $item->quantity]);
        }

        // Create payment with Mollie
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($total, 2, '.', ''),
            ],
            "description" => "Order #{$order->id}",
            "redirectUrl" => route('vineyard.orders.success'),
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);

        // Update order with payment ID
        $order->update(['payment_id' => $payment->id]);

        // Redirect to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    // Handle payment success callback from Mollie
    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->input('id');

        if (empty($paymentId)) {
            return redirect()->route('vineyard.home')->with('error', 'Payment ID is missing.');
        }

        try {
            // Retrieve payment details from Mollie
            $payment = Mollie::api()->payments->get($paymentId);

            // Find corresponding order
            $order = Order::findOrFail($payment->metadata->order_id);

            // Check if payment is successful
            if ($payment->isPaid()) {
                // Update order status to paid
                $order->update(['status' => 'paid']);

                // Clear cart items
                Cart::where('user_id', Auth::id())->delete();

                // Redirect to success page
                return view('frontend.shop.success');
            }

            return redirect()->route('vineyard.cart')->with('error', 'Payment failed.');
        } catch (\Exception $e) {
            return redirect()->route('vineyard.cart')->with('error', 'Payment verification failed.');
        }
    }



    // Product management routes
    public function index()
    {
        $products = Product::withTrashed()->paginate(20);
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->only('name', 'description', 'price', 'category_id'));

        if ($request->hasFile('product_image')) {
            $product->addMedia($request->file('product_image'))->toMediaCollection('product_images');
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($request->only('name', 'description', 'price', 'category_id'));

        if ($request->hasFile('product_image')) {
            $product->clearMediaCollection('product_images');
            $product->addMedia($request->file('product_image'))->toMediaCollection('product_images');
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index')->with('success', 'Product restored successfully.');
    }
}

