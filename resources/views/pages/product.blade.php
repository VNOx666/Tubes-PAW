@extends('layouts.app', ['title' => 'Detail Produk — Thrifty'])

@section('content')
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center text-zinc-400">Foto Produk</div>
            <div class="p-4 flex gap-2">
                @foreach (range(1, 4) as $i)
                    <div
                        class="h-16 w-16 rounded-2xl bg-zinc-100 border border-zinc-200 flex items-center justify-center text-xs text-zinc-400">
                        foto</div>
                @endforeach
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-black">Vintage Hoodie Oversize</h1>
                    <p class="text-zinc-600">Unisex • Grade A • Ukuran L (fit XL)</p>
                </div>
                <div class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">Ready</div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                <div class="flex items-end justify-between">
                    <div>
                        <div class="text-xs text-zinc-600">Harga</div>
                        <div class="text-3xl font-black">Rp 189.000</div>
                    </div>
                    <div class="text-right text-xs text-zinc-600">
                        <div>Seller: <span class="font-semibold text-black">ThriftKilat</span></div>
                        <div>Rating: <span class="font-semibold text-black">4.9★</span> (1.2k)</div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <a href="{{ route('cart') }}"
                        class="px-4 py-3 rounded-2xl bg-black text-white text-center hover:opacity-90">+ Keranjang</a>
                    <a href="{{ route('checkout') }}"
                        class="px-4 py-3 rounded-2xl border border-zinc-200 bg-white text-center hover:bg-zinc-50">Beli
                        Sekarang</a>
                </div>

                <div class="mt-3">
                    <a href="{{ route('chat') }}"
                        class="block px-4 py-3 rounded-2xl bg-zinc-900 text-white text-center hover:opacity-90">
                        Chat Penjual
                    </a>
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 space-y-2">
                <div class="font-bold">Deskripsi</div>
                <ul class="text-sm text-zinc-700 list-disc pl-5 space-y-1">
                    <li>Bahan tebal, nyaman, tidak panas.</li>
                    <li>Minus: ada titik kecil (lihat foto detail).</li>
                    <li>Siap kirim hari ini, packing aman.</li>
                </ul>
                <div class="pt-2 text-xs text-zinc-500">Kategori: Hoodie • Vintage • Oversize</div>
            </div>
        </div>
    </div>
@endsection
