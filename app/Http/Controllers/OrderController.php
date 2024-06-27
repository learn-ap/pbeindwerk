<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;

class OrderController extends Controller
{
    public function preparePayment()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // Attach products to order
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product_id, ['quantity' => $item->quantity]);
        }

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

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        $payment = Mollie::api()->payments->get($request->input('id'));
        $order = Order::findOrFail($payment->metadata->order_id);

        if ($payment->isPaid()) {
            $order->update(['status' => 'paid']);
            Cart::where('user_id', Auth::id())->delete();
            return view('frontend.shop.success');
        }

        return redirect()->route('vineyard.cart')->with('error', 'Payment failed.');
    }
}
