@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black">Keranjang</h1>
                <p class="text-zinc-600">Cek barang yang mau kamu checkout.</p>
            </div>

            @if (count($items ?? []) > 0)
                <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Kosongkan keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Kosongkan
                    </button>
                </form>
            @endif
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

        <div class="mt-6 grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
                @if (empty($items))
                    <div class="p-6 text-zinc-600">
                        Keranjang kamu kosong. <a href="{{ route('shop') }}" class="underline">Belanja dulu</a>.
                    </div>
                @else
                    <div class="divide-y divide-zinc-200">
                        @foreach ($items as $it)
                            @php($p = $it['product'])
                            <div class="p-4 flex gap-4">
                                <div
                                    class="h-20 w-20 rounded-2xl bg-zinc-100 border border-zinc-200 overflow-hidden flex items-center justify-center">
                                    @if ($p->image)
                                        <img src="{{ asset('storage/' . $p->image) }}" class="h-full w-full object-cover"
                                            alt="{{ $p->name }}">
                                    @else
                                        <span class="text-xs text-zinc-400">No Photo</span>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="font-bold">{{ $p->name }}</div>
                                    <div class="text-sm text-zinc-600">
                                        Rp {{ number_format($p->price, 0, ',', '.') }}
                                        • Stok {{ $p->quantity }}
                                    </div>

                                    <div class="mt-3 flex flex-wrap items-center gap-2">
                                        <form method="POST" action="{{ route('cart.update', $p) }}"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input name="qty" type="number" min="1" max="99"
                                                value="{{ $it['qty'] }}"
                                                class="w-24 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" />
                                            <button
                                                class="px-3 py-2 rounded-2xl bg-black text-white hover:opacity-90 text-sm">
                                                Update
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('cart.remove', $p) }}"
                                            onsubmit="return confirm('Hapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-3 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <div class="text-xs text-zinc-500">Subtotal</div>
                                    <div class="font-black">
                                        Rp {{ number_format($it['line_total'], 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit">
                <div class="font-bold">Ringkasan</div>
                <div class="mt-3 flex items-center justify-between text-sm">
                    <span class="text-zinc-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout') }}"
                    class="mt-4 block w-full text-center px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90
         {{ empty($items) ? 'pointer-events-none opacity-40' : '' }}">
                    Lanjut Checkout
                </a>

                <a href="{{ route('shop') }}"
                    class="mt-2 block w-full text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
@endsection
