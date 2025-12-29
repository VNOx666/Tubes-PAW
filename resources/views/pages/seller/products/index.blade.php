@extends('layouts.app', ['title' => 'Produk Saya — Thrifty'])

@section('content')
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">Produk Saya</h1>
            <p class="text-zinc-600">Kelola barang thrifting kamu (CRUD).</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
            + Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-5 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
        <div class="p-4 border-b border-zinc-200 flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
            <form class="flex gap-2 w-full sm:max-w-xl" method="GET" action="{{ route('seller.products.index') }}">
                <input name="q" value="{{ $q }}"
                    class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                    placeholder="Cari nama/kategori/grade..." />
                <select name="status" class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                    <option value="">Semua</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
                <button class="px-4 py-2 rounded-2xl bg-black text-white">Search</button>
            </form>
        </div>

        <div class="divide-y divide-zinc-200">
            @forelse($products as $product)
                <div class="p-4 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div
                        class="h-20 w-20 rounded-2xl bg-zinc-100 border border-zinc-200 overflow-hidden flex items-center justify-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover"
                                alt="{{ $product->name }}">
                        @else
                            <span class="text-xs text-zinc-400">No Photo</span>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <div class="font-bold">{{ $product->name }}</div>
                            <span
                                class="text-xs px-2 py-1 rounded-full
              {{ $product->status === 'active' ? 'bg-emerald-100 text-emerald-700' : '' }}
              {{ $product->status === 'draft' ? 'bg-zinc-200 text-zinc-700' : '' }}
              {{ $product->status === 'sold' ? 'bg-amber-100 text-amber-800' : '' }}
            ">
                                {{ strtoupper($product->status) }}
                            </span>
                        </div>
                        <div class="text-sm text-zinc-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            • {{ $product->category ?? '-' }}
                            • Grade {{ $product->grade ?? '-' }}
                            • Qty {{ $product->quantity }}
                        </div>
                        <div class="text-xs text-zinc-500">Slug: {{ $product->slug }}</div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('seller.products.edit', $product) }}"
                            class="px-3 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}"
                            onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-2 rounded-2xl bg-red-600 text-white hover:opacity-90 text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-zinc-600">Belum ada produk. Klik “Tambah Produk”.</div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
