@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-black">Pesanan Masuk</h1>
                <p class="text-zinc-600">Kelola status pengiriman untuk pesanan yang berisi produk kamu.</p>
            </div>
            <a href="{{ route('seller.dashboard') }}"
                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            @if ($orders->count() === 0)
                <div class="p-6 text-zinc-600">Belum ada pesanan untuk produk kamu.</div>
            @else
                <div class="divide-y divide-zinc-200">
                    @foreach ($orders as $o)
                        <a href="{{ route('seller.orders.show', $o) }}" class="block p-4 hover:bg-zinc-50">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="font-bold">{{ $o->code }}</div>
                                    <div class="text-sm text-zinc-600">
                                        Buyer: {{ $o->user->name }} • {{ $o->created_at->format('d M Y H:i') }}
                                    </div>
                                    <div class="text-xs text-zinc-500 mt-1">
                                        Item kamu: {{ $o->items->count() }} • Total order: Rp
                                        {{ number_format($o->total, 0, ',', '.') }}
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                                    {{ strtoupper($o->status) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="p-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
