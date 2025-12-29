@extends('layouts.app', ['title' => 'Thrifty Shop Campus — Thrifting Marketplace'])

@section('content')
    <section class="grid lg:grid-cols-2 gap-6 items-center">
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
                <a href="{{ route('shop') }}" class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
                    Mulai Belanja
                </a>

                {{-- tombol jual aman untuk semua kondisi --}}
                @auth
                    @if (auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}"
                            class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                            Dashboard Penjual
                        </a>
                    @else
                        <a href="{{ route('seller.dashboard') }}"
                            class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                            Jual Barang Kamu
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                        Jual Barang Kamu
                    </a>
                @endauth
            </div>

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

        <div class="relative">
            {{-- ✅ tambah pb-20 supaya area bawah aman tidak ketutup card seller --}}
            <div class="rounded-3xl bg-gradient-to-br from-zinc-900 to-zinc-700 p-8 pb-20 shadow-soft text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs opacity-80">Rekomendasi hari ini</div>
                        <div class="text-2xl font-bold">Vintage Oversize Hoodie</div>
                    </div>
                    <div class="text-xs px-3 py-1 rounded-full bg-white/10 border border-white/20">Grade A</div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    @foreach ([['Hoodie Nike 90s', 'Rp 189.000'], ['Denim Jacket', 'Rp 249.000'], ['Cargo Pants', 'Rp 159.000'], ['Leather Bag', 'Rp 129.000']] as $p)
                        <a href="{{ route('shop') }}"
                            class="rounded-2xl bg-white/10 border border-white/15 p-4 hover:bg-white/15">
                            <div class="text-sm font-semibold">{{ $p[0] }}</div>
                            <div class="text-xs opacity-80">{{ $p[1] }}</div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <div class="flex-1">
                        <div class="text-xs opacity-80">Status pengiriman</div>
                        <div class="font-semibold">Realtime tracking di halaman pesanan</div>
                    </div>

                    @auth
                        @if (auth()->user()->role === 'buyer')
                            <a href="{{ route('orders') }}" class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                                Lihat
                            </a>
                        @else
                            {{-- kalau route ini belum ada, bisa ganti ke seller.dashboard --}}
                            <a href="{{ route('seller.orders.index') }}"
                                class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                                Lihat
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            {{-- ✅ DIPINDAH ke dalam area gelap: tidak nutup teks --}}
            <div
                class="absolute bottom-[-40px] left-6 p-3 rounded-2xl bg-white border border-zinc-200 shadow-soft w-48 hidden sm:block z-10">


                <div class="text-xs text-zinc-700">Seller top minggu ini</div>
                <div class="font-semibold">ThriftKilat</div>
                <div class="text-xs text-zinc-700s">5.0 ★ • 1.2k transaksi</div>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <div class="flex items-end justify-between gap-3">
            <div>
                <h2 class="text-2xl font-black">New Drop</h2>
                <p class="text-zinc-600">Barang baru masuk, cepat habis.</p>
            </div>
            <a href="{{ route('shop') }}" class="px-4 py-2 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Lihat semua
            </a>
        </div>

        <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ([['slug' => 'hoodie-vintage', 'name' => 'Hoodie Vintage', 'price' => 'Rp 175.000', 'meta' => 'Oversize • Grade A'], ['slug' => 'jeans-90s', 'name' => 'Jeans 90s', 'price' => 'Rp 145.000', 'meta' => 'Straight • Rare'], ['slug' => 'jacket-denim', 'name' => 'Jacket Denim', 'price' => 'Rp 220.000', 'meta' => 'Unisex • Tebal'], ['slug' => 'bag-retro', 'name' => 'Tas Retro', 'price' => 'Rp 120.000', 'meta' => 'Leather-look']] as $item)
                <a href="{{ route('product', $item['slug']) }}"
                    class="group rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden hover:-translate-y-0.5 transition">
                    <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center text-zinc-400">
                        <span class="text-sm">Foto Produk</span>
                    </div>
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <div class="font-bold group-hover:underline">{{ $item['name'] }}</div>
                                <div class="text-xs text-zinc-600">{{ $item['meta'] }}</div>
                            </div>
                            <div class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">Ready</div>
                        </div>
                        <div class="mt-3 font-black">{{ $item['price'] }}</div>
                        <div class="mt-2 text-xs text-zinc-500">Seller: ThriftKilat • 4.9★</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
