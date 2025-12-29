<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Request $request, Order $order)
    {
        // hanya buyer pemilik order
        if ($order->user_id !== $request->user()->id) abort(403);

        // hanya setelah delivered
        if ($order->status !== 'delivered') {
            return redirect()->route('orders.detail', $order)
                ->with('error', 'Rating hanya bisa setelah pesanan DELIVERED.');
        }

        // seller (simple: seller pertama)
        $sellerId = $order->items()->value('seller_id');

        // kalau sudah pernah review
        $exists = Review::where('order_id', $order->id)
            ->where('buyer_id', $request->user()->id)
            ->where('seller_id', $sellerId)
            ->exists();

        if ($exists) {
            return redirect()->route('orders.detail', $order)
                ->with('error', 'Kamu sudah memberikan rating untuk pesanan ini.');
        }

        return view('pages.reviews.create', compact('order', 'sellerId'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) abort(403);
        if ($order->status !== 'delivered') abort(403);

        $sellerId = $order->items()->value('seller_id');

        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        Review::create([
            'order_id' => $order->id,
            'buyer_id' => $request->user()->id,
            'seller_id' => $sellerId,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);

        return redirect()->route('orders.detail', $order)->with('success', 'Rating berhasil dikirim.');
    }
}
