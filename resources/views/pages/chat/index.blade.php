@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-black">Chat</h1>
    <p class="text-zinc-600">Daftar percakapan kamu (bisa dari order atau chat langsung).</p>

    @php
        $isSellerArea = request()->is('seller/*') || (auth()->check() && auth()->user()->role === 'seller');
        $routeShow = $isSellerArea ? 'seller.chat.show' : 'chat.show';
    @endphp

    <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
        @if ($conversations->count() === 0)
            <div class="p-6 text-zinc-600">Belum ada percakapan.</div>
        @else
            <div class="divide-y divide-zinc-200">
                @foreach ($conversations as $c)
                    @php
                        $me = auth()->id();
                        $other = ($c->buyer_id === $me) ? $c->seller : $c->buyer;
                        $title = $c->order ? ('Order: ' . ($c->order->code ?? $c->order->id)) : ('Chat dengan ' . ($other->name ?? 'User'));
                        $sub = $c->order
                            ? ('Buyer: ' . ($c->buyer->name ?? '-') . ' • Seller: ' . ($c->seller->name ?? '-'))
                            : ('Dengan: ' . ($other->name ?? '-'));
                    @endphp

                    <a href="{{ route($routeShow, $c) }}" class="block p-4 hover:bg-zinc-50">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="font-bold">{{ $title }}</div>
                                <div class="text-sm text-zinc-600">{{ $sub }}</div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">Buka</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
