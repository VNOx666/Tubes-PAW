@extends('layouts.app', ['title' => 'Thrifty Shop Campus — Thrifting Marketplace'])

@section('content')
    <section class="grid lg:grid-cols-2 gap-6 items-center">
        {{-- KIRI --}}
        <div class="space-y-5">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900 text-white text-xs">
                Thrift Shop Campus
            </div>

            <h1 class="text-4xl sm:text-5xl font-black leading-tight">
                Cari barang thrift yang <span class="underline decoration-emerald-400">unik</span>, bukan yang pasaran.
            </h1>

            <p class="text-zinc-600 text-lg">
                Temukan hoodie vintage, jaket kulit, denim rare, sampai aksesori — semua dari penjual thrifting terpercaya.
            </p>

            <div class="flex flex-wrap gap-3">
<<<<<<< HEAD
                <a href="{{ route('shop') }}"
                    class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
                    Mulai Belanja
                </a>
=======
    @auth
        @if (auth()->user()->role === 'seller')
            {{-- ✅ SELLER: hanya boleh jual / dashboard --}}
            <a href="{{ route('seller.dashboard') }}"
               class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
                Dashboard Penjual
            </a>

            <a href="{{ route('seller.products.create') }}"
               class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                + Tambah Barang
            </a>
        @else
            {{-- ✅ BUYER: hanya boleh belanja --}}
            <a href="{{ route('shop') }}"
               class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
                Mulai Belanja
            </a>

            <a href="{{ route('orders') }}"
               class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                Lihat Pesanan
            </a>
        @endif
    @else
        {{-- ✅ GUEST: boleh lihat shop, tapi untuk jual harus login --}}
        <a href="{{ route('shop') }}"
           class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
            Mulai Belanja
        </a>

        <a href="{{ route('login') }}"
           class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
            Jual Barang Kamu
        </a>
    @endauth
</div>
>>>>>>> 98ae58acffc21e7d5c1fa648f93f41510df3fcbd


            <div class="grid grid-cols-3 gap-3 pt-4">
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">3K+</div>
                    <div class="text-xs text-zinc-600">Item siap checkout</div>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">4.8★</div>
                    <div class="text-xs text-zinc-600">Rating seller</div>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">24/7</div>
                    <div class="text-xs text-zinc-600">Chat & update status</div>
                </div>
            </div>
        </div>

        {{-- KANAN: CARD HITAM DIPERBESAR --}}
        <div class="relative">
            <div
                class="rounded-[2rem] bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-700 shadow-soft text-white
                       p-8 sm:p-10 min-h-[420px] sm:min-h-[520px] flex flex-col justify-between
                       overflow-hidden">

                {{-- Top --}}
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-xs opacity-80">Rekomendasi hari ini</div>
                        <div class="mt-1 text-3xl sm:text-4xl font-black leading-tight">
                            Vintage Oversize Hoodie
                        </div>
                    </div>
                    <div class="shrink-0 text-xs px-3 py-1 rounded-full bg-white/10 border border-white/20">
                        Grade A
                    </div>
                </div>

                {{-- Cards --}}
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ([['Hoodie Nike 90s', 'Rp 189.000'], ['Denim Jacket', 'Rp 249.000'], ['Cargo Pants', 'Rp 159.000'], ['Leather Bag', 'Rp 129.000']] as $p)
                        <a href="{{ route('shop') }}"
                            class="rounded-2xl bg-white/10 border border-white/15 p-5 hover:bg-white/15 transition">
                            <div class="text-base font-semibold">{{ $p[0] }}</div>
                            <div class="text-sm opacity-80 mt-1">{{ $p[1] }}</div>
                        </a>
                    @endforeach
                </div>

                {{-- Bottom --}}
                <div class="mt-8 flex items-center gap-3">
                    <div class="flex-1">
                        <div class="text-xs opacity-80">Status pengiriman</div>
                        <div class="text-lg font-semibold leading-snug">
                            Realtime tracking di halaman pesanan
                        </div>
                    </div>

                    @auth
                        @if (auth()->user()->role === 'buyer')
                            <a href="{{ route('orders') }}"
                                class="px-5 py-3 rounded-2xl bg-white text-black font-semibold hover:opacity-90">
                                Lihat
                            </a>
                        @else
                            <a href="{{ route('seller.orders.index') }}"
                                class="px-5 py-3 rounded-2xl bg-white text-black font-semibold hover:opacity-90">
                                Lihat
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-3 rounded-2xl bg-white text-black font-semibold hover:opacity-90">
                            Login
                        </a>
                    @endauth
                </div>

                {{-- Dekorasi --}}
                <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-emerald-400/10 blur-3xl"></div>
            </div>

            {{-- Card seller (posisi aman, tidak nutup konten) --}}
            <div
                class="absolute -bottom-10 left-6 p-4 rounded-2xl bg-white border border-zinc-200 shadow-soft w-60 hidden sm:block z-10">
                <div class="text-xs text-zinc-600">Seller top minggu ini</div>
                <div class="font-bold text-zinc-900">ThriftKilat</div>
                <div class="text-sm text-zinc-700">5.0 ★ • 1.2k transaksi</div>
            </div>
        </div>
    </section>

<<<<<<< HEAD
    <section class="mt-12">
        <div class="flex items-end justify-between gap-3">
            <div>
                <h2 class="text-2xl font-black">New Drop</h2>
                <p class="text-zinc-600">Barang baru masuk, cepat habis.</p>
            </div>
            <a href="{{ route('shop') }}"
                class="px-4 py-2 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Lihat semua
            </a>
=======
    {{-- NEW DROP (ukuran tetap, cuma ganti data jadi dinamis) --}}
<section class="mt-10">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h2 class="text-2xl font-black">New Drop</h2>
            <p class="text-zinc-600">Barang baru masuk, cepat habis.</p>
>>>>>>> 98ae58acffc21e7d5c1fa648f93f41510df3fcbd
        </div>

        <a href="{{ route('shop') }}" class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
            Lihat semua
        </a>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse ($newDrops as $product)
            <a href="{{ route('product', $product->slug) }}"
                class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden hover:shadow-md transition">
                <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center overflow-hidden">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover"
                            alt="{{ $product->name }}">
                    @else
                        <span class="text-zinc-400">Foto Produk</span>
                    @endif
                </div>

                <div class="p-4">
                    <div class="flex items-center justify-between gap-2">
                        <div class="font-bold line-clamp-1">{{ $product->name }}</div>

                        <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                            Ready
                        </span>
                    </div>

                    <div class="text-sm text-zinc-600 mt-1">
                        {{ $product->category ?? 'Tanpa kategori' }}
                        @if ($product->grade)
                            • Grade {{ $product->grade }}
                        @endif
                    </div>

                    <div class="mt-3 text-lg font-black">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="mt-2 text-sm text-zinc-600">
                        Seller: {{ $product->seller->name ?? 'Seller' }}
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full p-6 rounded-3xl bg-white border border-zinc-200 text-zinc-600">
                Belum ada produk yang dijual. Seller bisa mulai dari menu <b>Mode Seller</b> → <b>Tambah Produk</b>.
            </div>
        @endforelse
    </div>
</section>
@endsection
