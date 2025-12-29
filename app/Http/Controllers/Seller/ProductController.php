<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $q = $request->query('q');
        $status = $request->query('status');

        $products = Product::query()
            ->where('user_id', $user->id)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('category', 'like', "%{$q}%")
                        ->orWhere('grade', 'like', "%{$q}%");
                });
            })
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.seller.products.index', compact('products', 'q', 'status'));
    }

    public function create()
    {
        return view('pages.seller.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'grade' => ['nullable', 'in:A,B,C'],
            'size' => ['nullable', 'string', 'max:30'],
            'color' => ['nullable', 'string', 'max:50'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
            'status' => ['required', 'in:active,sold,draft'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // slug unique
        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => $request->user()->id,
            'name' => $data['name'],
            'slug' => $slug,
            'price' => $data['price'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'] ?? null,
            'grade' => $data['grade'] ?? null,
            'size' => $data['size'] ?? null,
            'color' => $data['color'] ?? null,
            'quantity' => $data['quantity'],
            'status' => $data['status'],
            'image' => $path,
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // ✅ tambahkan Request $request
    public function edit(Request $request, Product $product)
    {
        $this->authorizeOwner($request, $product);

        return view('pages.seller.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeOwner($request, $product);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'grade' => ['nullable', 'in:A,B,C'],
            'size' => ['nullable', 'string', 'max:30'],
            'color' => ['nullable', 'string', 'max:50'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
            'status' => ['required', 'in:active,sold,draft'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // jika nama berubah -> update slug (unik)
        if ($data['name'] !== $product->name) {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug;
            $i = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }
            $product->slug = $slug;
        }

        if ($request->hasFile('image')) {
            // hapus lama
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->fill([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'] ?? null,
            'grade' => $data['grade'] ?? null,
            'size' => $data['size'] ?? null,
            'color' => $data['color'] ?? null,
            'quantity' => $data['quantity'],
            'status' => $data['status'],
        ])->save();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // ✅ tambahkan Request $request
    public function destroy(Request $request, Product $product)
    {
        $this->authorizeOwner($request, $product);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // ✅ rapikan indent & parameter lengkap
    private function authorizeOwner(Request $request, Product $product): void
    {
        $user = $request->user();

        if (!$user || (int) $product->user_id !== (int) $user->id) {
            abort(403, 'Akses ditolak.');
        }
    }
}
