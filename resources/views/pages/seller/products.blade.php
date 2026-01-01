@extends('layouts.app', ['title' => ($product->name ?? 'Detail Produk') . ' — Thrifty'])

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- LEFT: IMAGE --}}
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center overflow-hidden">
                @if (!empty($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover"
                        alt="{{ $product->name }}">
                @else
                    <span class="text-zinc-400">Foto Produk</span>
                @endif
            </div>

            {{-- thumbnails (kalau belum ada sistem multiple images, ini placeholder aman) --}}
            <div class="p-4">
                <div class="flex gap-3">
                    @for ($i = 0; $i < 4; $i++)
                        <div
                            class="h-16 w-16 rounded-2xl bg-zinc-100 border border-zinc-200 flex items-center justify-center text-xs text-zinc-400">
                            foto
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- RIGHT: INFO --}}
        <div class="space-y-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-black">{{ $product->name }}</h1>
                    <div class="text-zinc-600 mt-1">
                        {{ $product->gender ?? 'Unisex' }}
                        @if (!empty($product->grade))
                            • Grade {{ $product->grade }}
                        @endif
                        @if (!empty($product->size))
                            • Ukuran {{ $product->size }}
                        @endif
                    </div>
                </div>

                @php
                    $isReady = ($product->status === 'active') && ((int) $product->quantity > 0);
                @endphp

                <span
                    class="text-xs px-3 py-1 rounded-full {{ $isReady ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-200 text-zinc-700' }}">
                    {{ $isReady ? 'Ready' : 'Sold' }}
                </span>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm text-zinc-600">Harga</div>
                        <div class="text-3xl font-black">
                            Rp {{ number_format((int) $product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="text-right text-sm text-zinc-600">
                        <div>Seller:
                            <a class="font-bold text-zinc-900 hover:underline"
                                href="{{ route('seller.profile', $product->seller_id ?? $product->seller->id ?? 0) }}">
                                {{ $product->seller->name ?? 'Seller' }}
                            </a>
                        </div>
                        <div>
                            Rating:
                            <span class="font-bold text-zinc-900">
                                {{ number_format((float) ($product->seller->rating_avg ?? 0), 1) }}★
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    {{-- tombol keranjang --}}
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 rounded-2xl bg-black text-white hover:opacity-90 disabled:opacity-50"
                            {{ $isReady ? '' : 'disabled' }}>
                            + Keranjang
                        </button>
                    </form>

                    {{-- tombol beli sekarang (arahin ke checkout / cart sesuai sistem kamu) --}}
                    <a href="{{ route('cart') }}"
                        class="px-6 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Beli Sekarang
                    </a>
                </div>

                <div class="mt-4">
                    {{-- Chat Penjual: kalau kamu belum punya sistem conversation, minimal arahkan ke /chat --}}
                    @auth
                        <a href="{{ route('chat') }}"
                            class="block text-center px-6 py-3 rounded-2xl bg-zinc-900 text-white hover:opacity-90">
                            Chat Penjual
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block text-center px-6 py-3 rounded-2xl bg-zinc-900 text-white hover:opacity-90">
                            Login untuk Chat Penjual
                        </a>
                    @endauth
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <div class="font-black text-lg mb-2">Deskripsi</div>

                @php
                    $desc = $product->description ?? null;
                @endphp

                @if ($desc)
                    <div class="text-zinc-700 whitespace-pre-line">{{ $desc }}</div>
                @else
                    <ul class="list-disc pl-5 text-zinc-700 space-y-1">
                        <li>Belum ada deskripsi.</li>
                        <li>Silakan chat penjual untuk detail tambahan.</li>
                    </ul>
                @endif

                <div class="mt-4 text-sm text-zinc-600">
                    Kategori: {{ $product->category ?? 'Tanpa kategori' }}
                </div>
            </div>
        </div>
    </div>
@endsection
