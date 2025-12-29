@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-6">
        <h1 class="text-2xl font-black">Dashboard Pembeli</h1>
        <p class="text-zinc-600 mt-1">Halo, {{ auth()->user()->name }} 👋</p>

        <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('shop') }}" class="p-4 rounded-2xl border border-zinc-200 hover:bg-zinc-50">
                <div class="font-bold">Belanja</div>
                <div class="text-sm text-zinc-600">Cari barang thrift terbaru</div>
            </a>
            <a href="{{ route('orders') }}" class="p-4 rounded-2xl border border-zinc-200 hover:bg-zinc-50">
                <div class="font-bold">Pesanan</div>
                <div class="text-sm text-zinc-600">Tracking & histori transaksi</div>
            </a>
            <a href="{{ route('chat') }}" class="p-4 rounded-2xl border border-zinc-200 hover:bg-zinc-50">
                <div class="font-bold">Chat</div>
                <div class="text-sm text-zinc-600">Tanya penjual dengan cepat</div>
            </a>
        </div>
    </div>
</div>
@endsection
