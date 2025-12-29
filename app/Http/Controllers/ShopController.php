<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $products = Product::query()
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            // ✅ supaya di shop.blade.php bisa akses $product->seller + rating
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
}
