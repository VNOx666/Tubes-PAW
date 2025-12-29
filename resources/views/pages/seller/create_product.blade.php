@extends('layouts.app', ['title' => 'Tambah Produk — Thrifty'])

@section('content')
    <h1 class="text-2xl font-black">Tambah Produk</h1>
    <p class="text-zinc-600">Upload foto, isi detail, dan publish.</p>

    <div class="mt-5 grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="grid sm:grid-cols-2 gap-3">
                <input class="rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="Nama produk" />
                <input class="rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="Harga (Rp)" />
                <select class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                    <option>Kategori</option>
                    <option>Hoodie</option>
                    <option>Jacket</option>
                    <option>Jeans</option>
                    <option>Tas</option>
                </select>
                <select class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                    <option>Grade</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
                <input class="rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="Ukuran (S/M/L/XL)" />
                <input class="rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="Warna" />
                <textarea class="sm:col-span-2 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" rows="5"
                    placeholder="Deskripsi lengkap, minus, bahan, dll"></textarea>
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit space-y-3">
            <div class="font-bold">Foto Produk</div>
            <div
                class="aspect-[4/3] rounded-2xl bg-zinc-100 border border-dashed border-zinc-300 flex items-center justify-center text-zinc-500 text-sm">
                Drop foto di sini
            </div>
            <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">Publish</button>
            <button class="w-full px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">Simpan
                Draft</button>
        </div>
    </div>
@endsection
