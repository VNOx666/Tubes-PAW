<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with(['seller', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.product.show', compact('product'));
    }
}
