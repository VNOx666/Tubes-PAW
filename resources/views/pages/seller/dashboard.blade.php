@extends('layouts.app', ['title' => 'Dashboard Penjual — Thrifty'])

@section('content')
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">Dashboard Penjual</h1>
            <p class="text-zinc-600">Kelola barang, order, status, dan chat.</p>
        </div>

        <a href="{{ route('seller.products.create') }}"
           class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
            + Tambah Barang
        </a>
    </div>

    {{-- Cards summary (dinamis dari DB) --}}
    <div class="mt-5 grid md:grid-cols-4 gap-4">
        @php
            $cards = [
                ['t' => 'Barang Aktif', 'v' => $activeProducts ?? 0],
                ['t' => 'Order Baru', 'v' => $newOrders ?? 0],
                ['t' => 'Dalam Pengiriman', 'v' => $inShipping ?? 0],
                ['t' => 'Rating', 'v' => (($rating ?? 0) . '★')],
            ];
        @endphp

        @foreach ($cards as $c)
            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                <div class="text-xs text-zinc-500">{{ $c['t'] }}</div>
                <div class="text-2xl font-black mt-1">{{ $c['v'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid lg:grid-cols-2 gap-6">
        {{-- Order terbaru (dinamis dari DB) --}}
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Order Terbaru</div>

            <div class="mt-3 space-y-2 text-sm">
                @forelse ($recentOrders as $order)
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-zinc-50 border border-zinc-200">
                        <span class="font-semibold">#{{ $order->id }}</span>

                        @php
                            $label = match($order->status) {
                                'pending'   => 'Menunggu Pembayaran',
                                'paid'      => 'Dibayar',
                                'packed'    => 'Dikemas',
                                'shipped'   => 'Dikirim',
                                'delivered' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default     => ucfirst($order->status),
                            };
                        @endphp

                        <span class="text-xs px-3 py-1 rounded-full bg-black text-white">{{ $label }}</span>
                    </div>
                @empty
                    <div class="p-3 rounded-2xl bg-zinc-50 border border-zinc-200 text-zinc-600">
                        Belum ada order masuk.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Shortcut (tetap) --}}
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Shortcut</div>

            <div class="mt-3 grid sm:grid-cols-2 gap-2">
                {{-- ✅ CRUD Barang --}}
                <a href="{{ route('seller.products.index') }}"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">CRUD Barang</div>
                    <div class="text-xs text-zinc-500">Tambah/edit/hapus barang</div>
                </a>

                {{-- ✅ Chat Seller --}}
                <a href="{{ route('seller.chat') }}"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Chat Pembeli</div>
                    <div class="text-xs text-zinc-500">Balas lebih cepat</div>
                </a>

                {{-- ✅ Tracking Status (Seller Orders) --}}
                <a href="{{ route('seller.orders.index') }}"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Tracking Status</div>
                    <div class="text-xs text-zinc-500">Update resi & status</div>
                </a>

                {{-- ✅ Profile (Breeze) --}}
                <a href="{{ route('profile.edit') }}"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Profil & Rating</div>
                    <div class="text-xs text-zinc-500">Lihat feedback</div>
                </a>
            </div>
        </div>
    </div
@endsection
