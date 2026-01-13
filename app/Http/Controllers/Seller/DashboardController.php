<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();

        $activeProducts = Product::where('user_id', $sellerId)
            ->where('status', '!=', 'sold')
            ->count();

        $newOrders = Order::whereHas('items', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->whereIn('status', ['pending', 'paid'])
            ->count();

        $inShipping = Order::whereHas('items', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->whereIn('status', ['packed', 'shipped'])
            ->count();

        $rating = DB::table('reviews')
            ->where('seller_id', $sellerId)
            ->avg('rating');
        $rating = $rating ? round($rating, 1) : 0;

        $recentOrders = Order::whereHas('items', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->with(['items' => function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            }])
            ->latest()
            ->limit(5)
            ->get();

        return view('pages.seller.dashboard', compact(
            'activeProducts', 'newOrders', 'inShipping', 'rating', 'recentOrders'
        ));
    }
}
