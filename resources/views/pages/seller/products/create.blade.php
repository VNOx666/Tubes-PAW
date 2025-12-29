@extends('layouts.app', ['title' => 'Tambah Produk — Thrifty'])

@section('content')
    <h1 class="text-2xl font-black">Tambah Produk</h1>
    <p class="text-zinc-600">Isi detail barang thrift kamu.</p>

    @if ($errors->any())
        <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="mt-5 grid lg:grid-cols-3 gap-6" method="POST" action="{{ route('seller.products.store') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="grid sm:grid-cols-2 gap-3">
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold">Nama Produk</label>
                    <input name="name" value="{{ old('name') }}"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                        placeholder="Vintage Hoodie Oversize" required />
                </div>

                <div>
                    <label class="text-sm font-semibold">Harga (Rp)</label>
                    <input name="price" value="{{ old('price') }}" type="number" min="0"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="189000"
                        required />
                </div>

                <div>
                    <label class="text-sm font-semibold">Kategori</label>
                    <input name="category" value="{{ old('category') }}"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                        placeholder="Hoodie / Jacket / Jeans" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Grade</label>
                    <select name="grade" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                        <option value="">-</option>
                        @foreach (['A', 'B', 'C'] as $g)
                            <option value="{{ $g }}" {{ old('grade') === $g ? 'selected' : '' }}>{{ $g }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold">Ukuran</label>
                    <input name="size" value="{{ old('size') }}"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                        placeholder="L / XL / 30" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Warna</label>
                    <input name="color" value="{{ old('color') }}"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" placeholder="Hitam" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Quantity</label>
                    <input name="quantity" value="{{ old('quantity', 1) }}" type="number" min="1" max="99"
                        class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" required />
                </div>

                <div>
                    <label class="text-sm font-semibold">Status</label>
                    <select name="status" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-white px-3 py-2"
                        required>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold">Deskripsi</label>
                    <textarea name="description" rows="5" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                        placeholder="Minus, bahan, kondisi, dll">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit space-y-3">
            <div class="font-bold">Foto Utama</div>
            <input name="image" type="file" accept="image/*" class="w-full" />
            <p class="text-xs text-zinc-500">Max 2MB (jpg/png/webp). Foto ini akan tampil di listing.</p>

            <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                Simpan Produk
            </button>

            <a href="{{ route('seller.products.index') }}"
                class="block w-full px-4 py-3 rounded-2xl border border-zinc-200 bg-white text-center hover:bg-zinc-50">
                Batal
            </a>
        </div>
    </form>
@endsection
