@extends('layouts.app')

@section('content')
@php
    $me = auth()->id();

    // Deteksi area seller (biar tombol back dan send route-nya benar)
    $isSellerArea = request()->is('seller/*') || (auth()->check() && auth()->user()->role === 'seller');

    $routeBack = $isSellerArea ? 'seller.chat' : 'chat';
    $routeSend = $isSellerArea ? 'seller.chat.send' : 'chat.send';

    // Nama lawan chat
    $otherName = $me === $conversation->buyer_id
        ? ($conversation->seller->name ?? 'Seller')
        : ($conversation->buyer->name ?? 'Buyer');

    // Judul: kalau ada order pakai order code, kalau tidak ada pakai nama lawan
    $title = $conversation->order
        ? ('Chat Order ' . ($conversation->order->code ?? $conversation->order->id))
        : ('Chat dengan ' . $otherName);

    $subtitle = 'Buyer: ' . ($conversation->buyer->name ?? '-') . ' • Seller: ' . ($conversation->seller->name ?? '-');
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">{{ $title }}</h1>
            <p class="text-zinc-600 text-sm">{{ $subtitle }}</p>
        </div>

        <a href="{{ route($routeBack) }}"
           class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
            Kembali
        </a>
    </div>

    <div class="mt-6 grid lg:grid-cols-3 gap-6">
        {{-- CHAT BOX --}}
        <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="p-4 border-b border-zinc-200 font-bold">Pesan</div>

            <div class="p-4 space-y-3 max-h-[520px] overflow-y-auto">
                @forelse($conversation->messages as $m)
                    <div class="flex {{ $m->sender_id === $me ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-[75%] rounded-2xl px-4 py-2
                            {{ $m->sender_id === $me ? 'bg-black text-white' : 'bg-zinc-100 text-zinc-900' }}">
                            <div class="text-xs opacity-70 mb-1">{{ $m->sender->name ?? 'User' }}</div>
                            <div class="whitespace-pre-line">{{ $m->body }}</div>
                            <div class="text-[11px] opacity-60 mt-1">{{ $m->created_at->format('d M H:i') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-zinc-600">Belum ada pesan.</div>
                @endforelse
            </div>

            <form method="POST" action="{{ route($routeSend, $conversation) }}"
                  class="p-4 border-t border-zinc-200 flex gap-2">
                @csrf
                <input name="body" required placeholder="Tulis pesan..."
                       class="flex-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" />
                <button class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">Kirim</button>
            </form>
        </div>

        {{-- INFO (KALAU ADA ORDER) --}}
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit">
            <div class="font-bold">Info</div>

            @if($conversation->order)
                <div class="mt-2 text-sm text-zinc-700 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Order</span>
                        <span class="font-semibold">{{ $conversation->order->code ?? $conversation->order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Status</span>
                        <span class="font-semibold">{{ strtoupper($conversation->order->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Total</span>
                        <span class="font-semibold">
                            Rp {{ number_format($conversation->order->total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @else
                <div class="mt-2 text-sm text-zinc-600">
                    Ini chat langsung (tanpa pesanan). Kamu bisa tanya detail produk, stok, atau nego.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
