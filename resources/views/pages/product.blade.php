@extends('layouts.app', ['title' => ($product->name ?? 'Detail Produk') . ' — Thrifty'])

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- LEFT: FOTO --}}
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center overflow-hidden">
                @if (!empty($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="w-full h-full object-cover"
                        alt="{{ $product->name }}">
                @else
                    <span class="text-zinc-400">Foto Produk</span>
                @endif
            </div>

            {{-- thumbnails (kalau kamu belum punya multiple image, biarin placeholder) --}}
            <div class="p-4 flex gap-3">
                @for ($i = 0; $i < 4; $i++)
                    <div class="h-16 w-16 rounded-2xl bg-zinc-100 border border-zinc-200 flex items-center justify-center text-xs text-zinc-400">
                        foto
                    </div>
                @endfor
            </div>
        </div>

        {{-- RIGHT: INFO --}}
        <div>
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-black">{{ $product->name }}</h1>
                    <p class="text-zinc-600 mt-1">
                        {{ $product->category ?? 'Tanpa kategori' }}
                        @if($product->grade) • Grade {{ $product->grade }} @endif
                        @if($product->size) • Ukuran {{ $product->size }} @endif
                    </p>
                </div>

                <span class="text-xs px-3 py-1 rounded-full
                    {{ $product->quantity > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-200 text-zinc-700' }}">
                    {{ $product->quantity > 0 ? 'Ready' : 'Sold' }}
                </span>
            </div>

            <div class="mt-4 rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-sm text-zinc-600">Harga</div>
                        <div class="text-3xl font-black">
                            Rp {{ number_format((int) $product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="text-right text-sm text-zinc-700">
                        <div>Seller: <b>{{ $product->seller->name ?? 'Seller' }}</b></div>
                    </div>
                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                            + Keranjang
                        </button>
                    </form>

                    <a href="{{ route('checkout') }}"
                        class="flex-1 text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Beli Sekarang
                    </a>
                </div>

                @auth
    @php
        $sellerId = $product->user_id ?? optional($product->seller)->id;
    @endphp

    @if(auth()->user()->role === 'buyer')
        <a href="{{ route('chat.start', $sellerId) }}"
           class="w-full px-4 py-3 rounded-2xl bg-zinc-900 text-white text-center hover:opacity-90 block mt-4">
            Chat Penjual
        </a>
    @else
        {{-- seller tidak boleh chat “penjual lain”, arahkan ke chat seller sendiri --}}
        <a href="{{ route('seller.chat') }}"
           class="w-full px-4 py-3 rounded-2xl bg-white border border-zinc-200 text-center hover:bg-zinc-50 block mt-4">
            Buka Chat Pembeli
        </a>
    @endif
@else
    <a href="{{ route('login') }}"
       class="w-full px-4 py-3 rounded-2xl bg-white border border-zinc-200 text-center hover:bg-zinc-50 block mt-4">
        Login untuk Chat
    </a>
@endauth

                </a>
            </div>

            <div class="mt-5 rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <h3 class="font-black text-lg">Deskripsi</h3>
                <div class="mt-2 text-zinc-700 leading-relaxed whitespace-pre-line">
                    {{ $product->description ?: 'Tidak ada deskripsi.' }}
                </div>

                <div class="mt-4 text-sm text-zinc-600">
                    Warna: {{ $product->color ?? '-' }} • Stok: {{ $product->quantity ?? 0 }}
                </div>
            </div>
        </div>
    </div>
@endsection
