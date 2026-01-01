<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Halaman shop (list produk)
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $products = Product::query()
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            ->with(['seller.receivedReviews'])
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('category', 'like', "%{$q}%")
                        ->orWhere('grade', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.shop', compact('products', 'q'));
    }

    /**
     * Halaman detail produk (INI YANG KAMU KURANG)
     */
    public function show(string $slug)
    {
        $product = Product::with('seller')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.product', compact('product'));
    }

}
