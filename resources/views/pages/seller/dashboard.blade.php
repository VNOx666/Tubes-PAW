@extends('layouts.app', ['title' => 'Dashboard Penjual — Thrifty'])

@section('content')
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">Dashboard Penjual</h1>
            <p class="text-zinc-600">Kelola barang, order, status, dan chat.</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">+
            Tambah Barang</a>
    </div>

    <div class="mt-5 grid md:grid-cols-4 gap-4">
        @foreach ([['t' => 'Barang Aktif', 'v' => '24'], ['t' => 'Order Baru', 'v' => '3'], ['t' => 'Dalam Pengiriman', 'v' => '5'], ['t' => 'Rating', 'v' => '4.9★']] as $c)
            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                <div class="text-xs text-zinc-500">{{ $c['t'] }}</div>
                <div class="text-2xl font-black mt-1">{{ $c['v'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid lg:grid-cols-2 gap-6">
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Order Terbaru</div>
            <div class="mt-3 space-y-2 text-sm">
                @foreach ([['#201', 'Dikemas'], ['#202', 'Menunggu Resi'], ['#203', 'Dikirim']] as $o)
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-zinc-50 border border-zinc-200">
                        <span class="font-semibold">{{ $o[0] }}</span>
                        <span class="text-xs px-3 py-1 rounded-full bg-black text-white">{{ $o[1] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Shortcut</div>
            <div class="mt-3 grid sm:grid-cols-2 gap-2">
                <a href="{{ route('seller.products.index') }}"
                    class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">CRUD Barang</div>
                    <div class="text-xs text-zinc-500">Tambah/edit/hapus barang</div>
                </a>
                <a href="{{ route('chat') }}" class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Chat Pembeli</div>
                    <div class="text-xs text-zinc-500">Balas lebih cepat</div>
                </a>
                <a href="{{ route('orders') }}" class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Tracking Status</div>
                    <div class="text-xs text-zinc-500">Update resi & status</div>
                </a>
                <a href="{{ route('profile') }}" class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Profil & Rating</div>
                    <div class="text-xs text-zinc-500">Lihat feedback</div>
                </a>
            </div>
        </div>
    </div>
@endsection
