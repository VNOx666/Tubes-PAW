@extends('layouts.app', ['title' => 'Produk Saya — Thrifty'])

@section('content')
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">Produk Saya</h1>
            <p class="text-zinc-600">CRUD barang thrifting kamu.</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">+
            Tambah Barang</a>
    </div>

    <div class="mt-5 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
        <div class="p-4 border-b border-zinc-200 flex items-center justify-between gap-3">
            <input class="w-full max-w-md rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                placeholder="Cari produk..." />
            <select class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                <option>Semua</option>
                <option>Ready</option>
                <option>Sold</option>
            </select>
        </div>

        <div class="divide-y divide-zinc-200">
            @foreach (range(1, 6) as $i)
                <div class="p-4 flex items-center gap-4">
                    <div
                        class="h-16 w-16 rounded-2xl bg-zinc-100 border border-zinc-200 flex items-center justify-center text-xs text-zinc-400">
                        foto</div>
                    <div class="flex-1">
                        <div class="font-bold">Produk #{{ $i }}</div>
                        <div class="text-sm text-zinc-600">Rp {{ number_format(100000 + $i * 10000, 0, ',', '.') }} • Grade A
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="px-3 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">Edit</button>
                        <button class="px-3 py-2 rounded-2xl bg-red-600 text-white hover:opacity-90 text-sm">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
