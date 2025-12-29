<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Keranjang masih kosong.');
        }

        $ids = array_keys($cart);
        $products = Product::whereIn('id', $ids)->get()->keyBy('id');

        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $qty) {
            $p = $products->get((int)$productId);
            if (!$p) continue;

            $line = $p->price * $qty;
            $subtotal += $line;

            $items[] = [
                'product' => $p,
                'qty' => $qty,
                'line_total' => $line,
            ];
        }

        // shipping dummy (nanti bisa dibuat dinamis)
        $shipping_fee = $subtotal >= 300000 ? 0 : 15000;
        $total = $subtotal + $shipping_fee;

        return view('pages.checkout', compact('items', 'subtotal', 'shipping_fee', 'total'));
    }

    public function place(Request $request)
    {
        $data = $request->validate([
            'receiver_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string'],
            'note' => ['nullable', 'string'],
        ]);

        $cart = $request->session()->get('cart', []);
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Keranjang masih kosong.');
        }

        $ids = array_keys($cart);

        return DB::transaction(function () use ($request, $data, $cart, $ids) {
            // lock produk biar aman dari race condition
            $products = Product::whereIn('id', $ids)->lockForUpdate()->get()->keyBy('id');

            $subtotal = 0;
            $itemsPayload = [];

            foreach ($cart as $productId => $qty) {
                $p = $products->get((int)$productId);
                if (!$p) continue;

                if ($qty > $p->quantity) {
                    abort(422, "Stok '{$p->name}' tidak mencukupi.");
                }

                $line = $p->price * $qty;
                $subtotal += $line;

                $itemsPayload[] = [
                    'product' => $p,
                    'qty' => $qty,
                    'line_total' => $line,
                ];
            }

            if (!$itemsPayload) {
                return redirect()->route('cart')->with('error', 'Keranjang tidak valid.');
            }

            $shipping_fee = $subtotal >= 300000 ? 0 : 15000;
            $total = $subtotal + $shipping_fee;

            // code invoice unik
            $code = 'TRF-' . strtoupper(Str::random(8));

            $order = Order::create([
                'user_id' => $request->user()->id,
                'code' => $code,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_fee' => $shipping_fee,
                'total' => $total,
                'receiver_name' => $data['receiver_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'note' => $data['note'] ?? null,
            ]);

            foreach ($itemsPayload as $it) {
                /** @var Product $p */
                $p = $it['product'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'seller_id' => $p->user_id,
                    'product_name' => $p->name,
                    'price' => $p->price,
                    'qty' => $it['qty'],
                    'line_total' => $it['line_total'],
                ]);

                // kurangi stok
                $p->quantity = $p->quantity - $it['qty'];

                // jika stok habis -> sold
                if ($p->quantity <= 0) {
                    $p->quantity = 0;
                    $p->status = 'sold';
                }

                $p->save();
            }

            // kosongkan cart
            $request->session()->forget('cart');

            return redirect()->route('orders.detail', $order->id)
                ->with('success', 'Order berhasil dibuat. Silakan lanjut pembayaran.');
        });
    }
}
