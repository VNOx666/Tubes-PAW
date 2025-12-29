@extends('layouts.app', ['title' => 'Shop — Thrifty'])

@section('content')
    <div class="flex flex-col lg:flex-row gap-6">
        {{-- SIDEBAR FILTER (UI dulu, belum jalan) --}}
        <aside class="lg:w-72 space-y-4">
            <div class="rounded-3xl bg-white border border-zinc-200 p-4 shadow-soft">
                <div class="font-bold mb-3">Filter</div>

                <label class="text-xs text-zinc-600">Kategori</label>
                <select class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2">
                    <option>Semua</option>
                    <option>Hoodie</option>
                    <option>Jacket</option>
                    <option>Jeans</option>
                    <option>Tas</option>
                </select>

                <div class="mt-3 grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs text-zinc-600">Min</label>
                        <input class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                            placeholder="50k" />
                    </div>
                    <div>
                        <label class="text-xs text-zinc-600">Max</label>
                        <input class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                            placeholder="300k" />
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-xs text-zinc-600">Grade</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach (['A', 'B', 'C'] as $g)
                            <button type="button"
                                class="px-3 py-1 rounded-full border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">
                                {{ $g }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button type="button"
                    class="mt-4 w-full px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
                    Terapkan
                </button>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 p-4 shadow-soft">
                <div class="font-bold">Tips Thrifting</div>
                <p class="text-sm text-zinc-600 mt-2">
                    Cek ukuran, detail noda, dan selalu chat penjual untuk foto tambahan.
                </p>
            </div>
        </aside>

        {{-- MAIN --}}
        <section class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-black">Shop</h1>
                    <p class="text-zinc-600 text-sm">
                        Hasil pencarian:
                        <span class="font-semibold">“{{ $q ?? 'Semua' }}”</span>
                    </p>
                </div>

                <div class="flex gap-2">
                    <select class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                        <option>Terbaru</option>
                        <option>Termurah</option>
                        <option>Termahal</option>
                        <option>Rating Seller</option>
                    </select>

                    {{-- Keranjang hanya untuk buyer (route cart ada di middleware buyer) --}}
                    @auth
                        @if(auth()->user()->role === 'buyer')
                            <a href="{{ route('cart') }}"
                                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                                Keranjang
                            </a>
                        @else
                            <a href="{{ route('seller.orders.index') }}"
                                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                                Mode Seller
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            {{-- GRID PRODUK DARI DATABASE --}}
            <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($products as $product)
                    @php
                        $seller = $product->seller ?? null;
                        $avg = $seller ? round($seller->averageRating(), 1) : 0;
                        $cnt = $seller ? $seller->ratingCount() : 0;
                    @endphp

                    <a href="{{ route('product', $product->slug) }}"
                        class="group rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden hover:-translate-y-0.5 transition">
                        <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center text-zinc-400 overflow-hidden">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover" />
                            @else
                                <span class="text-sm">Foto Produk</span>
                            @endif
                        </div>

                        <div class="p-4">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="font-bold group-hover:underline">{{ $product->name }}</div>
                                    <div class="text-xs text-zinc-600">
                                        {{ $product->category ?? 'Unisex' }}
                                        @if($product->grade) • Grade {{ $product->grade }} @endif
                                        @if($product->size) • Size {{ $product->size }} @endif
                                    </div>
                                </div>

                                @if ($product->quantity > 0)
                                    <div class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">Ready</div>
                                @else
                                    <div class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">Habis</div>
                                @endif
                            </div>

                            <div class="mt-3 font-black">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <div class="mt-2 text-xs text-zinc-500">
                                Seller:
                                @if ($seller)
                                    <a href="{{ route('seller.profile', $seller) }}"
                                        class="underline hover:no-underline font-semibold">
                                        {{ $seller->name }}
                                    </a>
                                    • {{ $avg }}★
                                    <span class="text-zinc-400">({{ $cnt }})</span>
                                @else
                                    Unknown
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full p-6 rounded-3xl bg-white border border-zinc-200 text-zinc-600">
                        Produk tidak ditemukan.
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </section>
    </div>
@endsection
