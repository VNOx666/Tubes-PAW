<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    public function index(Request $request)
    {
        $cart = $this->cart($request);

        $ids = array_keys($cart);
        $products = $ids ? Product::whereIn('id', $ids)->get()->keyBy('id') : collect();

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

        return view('pages.cart', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'qty' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        $qty = (int)($request->input('qty', 1));

        // thrifting biasanya qty 1, tapi tetap kita hormati stok
        if ($qty > $product->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->cart($request);
        $cart[$product->id] = min(($cart[$product->id] ?? 0) + $qty, $product->quantity);

        $this->saveCart($request, $cart);

        return redirect()->route('cart')->with('success', 'Produk masuk keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $qty = (int)$data['qty'];

        if ($qty > $product->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->cart($request);
        if (!isset($cart[$product->id])) {
            return back()->with('error', 'Produk tidak ada di keranjang.');
        }

        $cart[$product->id] = $qty;
        $this->saveCart($request, $cart);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $this->cart($request);
        unset($cart[$product->id]);
        $this->saveCart($request, $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
