<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $sellerId = $request->user()->id;

        // Ambil order yang punya item milik seller
        $orders = Order::query()
            ->whereHas('items', fn ($q) => $q->where('seller_id', $sellerId))
            ->with(['user', 'items' => fn ($q) => $q->where('seller_id', $sellerId)])
            ->latest()
            ->paginate(10);

        return view('pages.seller.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        $sellerId = $request->user()->id;

        // Pastikan order ini memang punya item milik seller
        $has = $order->items()->where('seller_id', $sellerId)->exists();
        if (!$has) abort(403);

        $order->load([
            'user',
            'items' => fn ($q) => $q->where('seller_id', $sellerId),
        ]);

        return view('pages.seller.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $sellerId = $request->user()->id;

        $has = $order->items()->where('seller_id', $sellerId)->exists();
        if (!$has) abort(403);

        $data = $request->validate([
            'status' => ['required', 'in:pending,paid,packed,shipped,delivered,cancelled'],
        ]);

        // Rule sederhana: tidak boleh mundur status (opsional)
        $steps = ['pending'=>1,'paid'=>2,'packed'=>3,'shipped'=>4,'delivered'=>5,'cancelled'=>99];
        $old = $order->status;
        $new = $data['status'];

        if ($old !== 'cancelled' && $new !== 'cancelled' && $steps[$new] < ($steps[$old] ?? 1)) {
            return back()->with('error', 'Status tidak boleh mundur.');
        }

        $order->status = $new;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
