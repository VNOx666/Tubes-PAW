@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-black">Checkout</h1>
        <p class="text-zinc-600">Isi alamat pengiriman dan konfirmasi order.</p>

        @if (session('error'))
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.place') }}" class="mt-6 grid lg:grid-cols-3 gap-6">
            @csrf

            <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                <div class="grid sm:grid-cols-2 gap-3">
                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Nama Penerima</label>
                        <input name="receiver_name" value="{{ old('receiver_name') }}" required
                            class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">No. HP</label>
                        <input name="phone" value="{{ old('phone') }}" required
                            class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Alamat Lengkap</label>
                        <textarea name="address" rows="4" required
                            class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2">{{ old('address') }}</textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Catatan (opsional)</label>
                        <textarea name="note" rows="3" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2">{{ old('note') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit">
                <div class="font-bold">Ringkasan Belanja</div>

                <div class="mt-3 space-y-2 text-sm">
                    @foreach ($items as $it)
                        <div class="flex justify-between gap-3">
                            <span class="text-zinc-600">{{ $it['product']->name }} × {{ $it['qty'] }}</span>
                            <span class="font-semibold">Rp {{ number_format($it['line_total'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 border-t border-zinc-200 pt-3 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Ongkir</span>
                        <span class="font-semibold">Rp {{ number_format($shipping_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-base">
                        <span class="font-bold">Total</span>
                        <span class="font-black">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button class="mt-4 w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                    Buat Pesanan
                </button>

                <a href="{{ route('cart') }}"
                    class="mt-2 block w-full text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Kembali ke Keranjang
                </a>
            </div>
        </form>
    </div>
@endsection
