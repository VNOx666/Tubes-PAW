@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-black">Detail Pesanan (Seller)</h1>
                <p class="text-zinc-600">{{ $order->code }} • Buyer: {{ $order->user->name }}</p>
            </div>
            <a href="{{ route('seller.orders.index') }}"
                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
        @endif

        <div class="mt-6 grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
                <div class="p-4 border-b border-zinc-200 flex items-center justify-between">
                    <div class="font-bold">Item Kamu</div>
                    <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>

                <div class="divide-y divide-zinc-200">
                    @foreach ($order->items as $it)
                        <div class="p-4 flex items-center justify-between gap-3">
                            <div>
                                <div class="font-semibold">{{ $it->product_name }}</div>
                                <div class="text-sm text-zinc-600">
                                    Rp {{ number_format($it->price, 0, ',', '.') }} × {{ $it->qty }}
                                </div>
                            </div>
                            <div class="font-black">
                                Rp {{ number_format($it->line_total, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit space-y-4">
                <div>
                    <div class="font-bold">Update Status</div>
                    <p class="text-sm text-zinc-600">Ubah progres pengiriman.</p>
                </div>

                <form method="POST" action="{{ route('seller.orders.status', $order) }}" class="space-y-3">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="w-full rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                        @foreach (['pending', 'paid', 'packed', 'shipped', 'delivered', 'cancelled'] as $s)
                            <option value="{{ $s }}" @selected($order->status === $s)>
                                {{ strtoupper($s) }}
                            </option>
                        @endforeach
                    </select>

                    <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                        Simpan Status
                    </button>
                </form>

                <div class="border-t border-zinc-200 pt-3 text-sm">
                    <div class="font-semibold">Alamat Buyer</div>
                    <div class="text-zinc-600 mt-1 whitespace-pre-line">{{ $order->address }}</div>
                    <div class="text-zinc-600 mt-1">{{ $order->receiver_name }} • {{ $order->phone }}</div>
                </div>

                <a href="{{ route('seller.chat') }}"
                    class="block w-full text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Buka Chat
                </a>
            </div>
        </div>
    </div>
@endsection
