<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PublicProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::query()
            ->with(['seller.receivedReviews.buyer']) // review milik seller
            ->where('slug', $slug)
            ->firstOrFail();

        $seller = $product->seller;

        $avg = $seller ? round($seller->averageRating(), 1) : 0;
        $cnt = $seller ? $seller->ratingCount() : 0;

        // ambil beberapa ulasan seller buat ditampilkan (opsional)
        $reviews = $seller
            ? $seller->receivedReviews()->latest()->take(20)->get()
            : collect();

        return view('pages.product', compact('product', 'avg', 'cnt', 'reviews'));
    }
}
