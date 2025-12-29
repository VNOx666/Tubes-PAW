<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\OrderApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route di sini otomatis prefix: /api
| dan return JSON (REST API)
*/

Route::get('/products', [ProductApiController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartApiController::class, 'index']);
    Route::post('/cart/{product}/add', [CartApiController::class, 'add']);
    Route::get('/orders', [OrderApiController::class, 'index']);
});
