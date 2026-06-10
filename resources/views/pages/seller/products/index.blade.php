@extends('layouts.app', ['title' => 'Produk Saya — Thrifty'])

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-black">Produk Saya</h1>
                <p class="text-zinc-600">CRUD barang thrifting kamu.</p>
            </div>

            <a href="{{ route('seller.products.create') }}"
                class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
                + Tambah Barang
            </a>
        </div>

        <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="p-4 flex items-center justify-between gap-3">
                <form method="GET" class="flex-1">
                    <input name="q" value="{{ request('q') }}"
                        class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3"
                        placeholder="Cari produk..." />
                </form>

                <form method="GET">
                    <select name="status" onchange="this.form.submit()"
                        class="rounded-2xl border border-zinc-200 bg-white px-4 py-3">
                        <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </form>
            </div>

            <div class="divide-y divide-zinc-100">
                @forelse($products as $product)
                    <div class="p-4 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-zinc-100 overflow-hidden flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <span class="text-xs text-zinc-400">foto</span>
                                @endif
                            </div>

                            <div>
                                <div class="font-bold">{{ $product->name }}</div>
                                <div class="text-sm text-zinc-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                    @if($product->grade) • Grade {{ $product->grade }} @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('seller.products.edit', $product) }}"
                                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('seller.products.destroy', $product) }}"
                                onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-4 py-2 rounded-2xl bg-red-600 text-white hover:opacity-90">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-zinc-600">Belum ada produk. Klik <b>Tambah Barang</b> untuk mulai.</div>
                @endforelse
            </div>

            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>
@endsection
