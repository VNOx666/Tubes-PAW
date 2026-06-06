<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicProductController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\SellerProfileController;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Detail product (public)
Route::get('/product/{slug}', [PublicProductController::class, 'show'])->name('product');

// Public seller profile (biar tidak bentrok dengan /seller prefix)
Route::get('/seller/{user}', [SellerProfileController::class, 'show'])
    ->whereNumber('user')
    ->name('seller.profile');


/*
|--------------------------------------------------------------------------
| Dashboard (Auth)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // kalau masih kepakai (tapi kamu tadi minta switch dihapus dari UI)
    Route::post('/profile/switch-role', [ProfileController::class, 'switchRole'])->name('profile.switchRole');
});


/*
|--------------------------------------------------------------------------
| Buyer Only (auth + role:buyer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:buyer'])->group(function () {
    Route::get('/chat/start/{seller}', [ChatController::class, 'start'])->name('chat.start');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');

    // Orders buyer
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.detail');

    // Review
    Route::get('/orders/{order}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // Chat buyer
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/order/{order}', [ChatController::class, 'showByOrder'])->name('chat.order');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation}', [ChatController::class, 'send'])->name('chat.send');

    // ✅ START CHAT dari halaman produk (buat conversation buyer-seller)
    Route::get('/chat/start/{seller}', [ChatController::class, 'start'])
        ->whereNumber('seller')
        ->name('chat.start');
});


/*
|--------------------------------------------------------------------------
| Seller Only (auth + role:seller)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        Route::get('/', [SellerDashboardController::class, 'index'])->name('dashboard');

        // CRUD products seller
        Route::resource('products', SellerProductController::class)->except(['show', 'edit', 'update']);

        // seller orders
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.status');

        // chat seller
        Route::get('/chat', [ChatController::class, 'index'])->name('chat');
        Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/{conversation}', [ChatController::class, 'send'])->name('chat.send');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
