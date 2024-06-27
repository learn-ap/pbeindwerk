<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VineyardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;

//Route::get('/', function () {
//    return view('frontend.index');
//})->name('        web webshop');
//
//Route::get('/', [HomeController::class, 'index'])->name('webshop');
//Route::get('/shoplist', [ShopController::class, 'indexFrontend'])->name('shoplist');
//Route::get('/product/{id}', [ProductController::class, 'showFrontend'])->name('shopdetail');
// Frontend routes

Route::prefix('vineyard')->group(function () {
    Route::get('/', [VineyardController::class, 'featuredFrontend'])->name('vineyard.home');
    Route::get('/shoplist', [VineyardController::class, 'indexFrontend'])->name('vineyard.shoplist');
    Route::get('/shopdetail/{id}', [VineyardController::class, 'showFrontend'])->name('vineyard.shopdetail');

    Route::middleware('auth')->group(function () {
// Cart routes
        Route::get('/cart', [VineyardController::class, 'cartIndex'])->name('vineyard.cart');
        Route::post('/cart/add/{product}', [VineyardController::class, 'cartAdd'])->name('vineyard.cart.add');
        Route::put('/cart/update/{cart}', [VineyardController::class, 'cartUpdate'])->name('vineyard.cart.update');
        Route::delete('/cart/remove/{cart}', [VineyardController::class, 'cartRemove'])->name('vineyard.cart.remove');

// Checkout route
        Route::post('/checkout', [VineyardController::class, 'checkout'])->name('vineyard.shop.checkout');

// Payment routes
        Route::get('/orders/prepare', [VineyardController::class, 'preparePayment'])->name('vineyard.orders.prepare');
        Route::get('/orders/success', [VineyardController::class, 'paymentSuccess'])->name('vineyard.orders.success');
    });
});



// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin|employee'])->group(function () {
    Route::get('/', function () {
        return view('backend.index');
    })->name('backend.dashboard');

    Route::get('/', [AdminController::class, 'index'])->name('backend.dashboard');

    Route::resource('users', UserController::class);
    Route::patch('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

    Route::resource('products', ProductController::class);
    Route::patch('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::resource('categories', CategoryController::class);
    Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profiel routes
Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//// Winkel routes
//Route::prefix('shop')->group(function () {
//    Route::get('/', [ProductController::class, 'showFrontendShop'])->name('frontend.shop.index');
//});

//// Winkelwagen en Bestellingen routes
//Route::prefix('cart.blade.php')->middleware('auth')->group(function () {
//    Route::get('/', [CartController::class, 'index'])->name('cart.blade.php.index');
//    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.blade.php.add');
//    Route::delete('/remove/{cart.blade.php}', [CartController::class, 'remove'])->name('cart.blade.php.remove');
//});
//
//Route::prefix('orders')->middleware('auth')->group(function () {
//    Route::post('/prepare', [OrderController::class, 'preparePayment'])->name('orders.prepare');
//    Route::get('/success', [OrderController::class, 'success'])->name('orders.success');
//    //Route::post('/webhooks/mollie', [OrderController::class, 'handleWebhookNotification'])->name('webhooks.mollie');
//});

require __DIR__.'/auth.php';


//voorbeeld
// Route::xxxx('/urlName', [ControllerName::class, 'methodName -> function binnen de controller']);
//         Route::get('/test', [UserController::class, 'index']); -> //oude manier om aan de user table to komen

//Route::resource => handelt de CRUD routes zoals create, edit, enz... (hier geef je opdracht)
// de controller zorgt voor de uitvoering
