<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CartApiController extends Controller
{
    public function index()
    {
        return session('cart', []);
    }

    public function add(Product $product)
    {
        $cart = session('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => ($cart[$product->id]['qty'] ?? 0) + 1,
        ];
        session(['cart' => $cart]);

        return $cart;
    }
}
