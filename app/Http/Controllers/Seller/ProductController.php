<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sellerId = auth()->id();

        $query = Product::where('user_id', $sellerId);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('pages.seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.seller.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'grade' => ['nullable', 'string', 'max:10'],
            'status' => ['nullable', 'string', 'max:20'], // ready/sold dll
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['user_id'] = auth()->id();

        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (\App\Models\Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        \App\Models\Product::create($data);

        return redirect()->route('seller.products.index')->with('status', 'Produk berhasil ditambahkan');
    }


    /**
     * DELETE /seller/products/{product}
     */
    public function destroy(Product $product)
    {
        // keamanan: seller cuma boleh hapus produknya sendiri
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan menghapus produk ini.');
        }

        // hapus file gambar di storage kalau ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('seller.products.index')
            ->with('status', 'Produk berhasil dihapus.');
    }
}
