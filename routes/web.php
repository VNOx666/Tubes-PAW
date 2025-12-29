<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\SellerProfileController;

/*
|--------------------------------------------------------------------------
| Public Pages (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('pages.home'))->name('home');   // ✅ ini ganti welcome

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/product/{slug}', fn (string $slug) => view('pages.product', compact('slug')))
    ->name('product');

// Profil seller (public)
Route::get('/seller/{user}', [SellerProfileController::class, 'show'])
    ->name('seller.profile');

/*
|--------------------------------------------------------------------------
| Dashboard (bawaan Breeze) - kita arahkan sesuai role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Buyer Only (auth + role:buyer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:buyer'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');

    // Orders + Tracking
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.detail');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/order/{order}', [ChatController::class, 'showByOrder'])->name('chat.order');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation}', [ChatController::class, 'send'])->name('chat.send');

    // Review
    Route::get('/orders/{order}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');
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
        Route::get('/', fn () => view('pages.seller.dashboard'))->name('dashboard');

        // CRUD products
        Route::resource('products', SellerProductController::class)->except(['show']);

        // Seller Orders
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.status');

        // Chat seller (pakai controller yang sama)
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
