<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        return Product::where('status', 'active')
            ->where('quantity', '>', 0)
            ->latest()
            ->get();
    }
}
