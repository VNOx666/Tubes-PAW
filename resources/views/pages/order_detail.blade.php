@extends('layouts.app')

@section('content')
    @php
        $steps = [
            'pending' => 'Pesanan Dibuat',
            'paid' => 'Pembayaran Berhasil',
            'packed' => 'Dikemas Penjual',
            'shipped' => 'Dikirim (Kurir)',
            'delivered' => 'Sampai (Delivered)',
        ];

        $keys = array_keys($steps);
        $orderStep = array_search($order->status, $keys, true);
        $orderStep = $orderStep === false ? -1 : $orderStep;

        $isCancelled = $order->status === 'cancelled';

        // ✅ Progress Bar (sesuai yang kamu minta)
        $progress = count($steps) > 1 ? max(0, min(100, ($orderStep / (count($steps) - 1)) * 100)) : 0;
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black">Detail Pesanan</h1>
                <p class="text-zinc-600">{{ $order->code }}</p>

                {{-- ✅ Tombol aksi Bagian 4 --}}
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="{{ route('chat.order', $order) }}"
                        class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
                        Chat Penjual
                    </a>

                    @if ($order->status === 'delivered')
                        <a href="{{ route('reviews.create', $order) }}"
                            class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                            Beri Rating
                        </a>
                    @endif
                </div>
            </div>

            <a href="{{ route('orders') }}"
                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Kembali
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

        <div class="mt-6 grid lg:grid-cols-3 gap-6">
            {{-- KIRI: Item + Timeline --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
                    <div class="p-4 border-b border-zinc-200 flex items-center justify-between">
                        <div class="font-bold">Item</div>
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

                {{-- ✅ Bagian 6: Tracking Timeline --}}
                <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                    <div class="flex items-center justify-between">
                        <div class="font-bold">Tracking Status</div>

                        @if ($isCancelled)
                            <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">CANCELLED</span>
                        @else
                            <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                                {{ strtoupper($order->status) }}
                            </span>
                        @endif
                    </div>

                    @if ($isCancelled)
                        <div class="mt-3 p-3 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
                            Pesanan dibatalkan. Silakan hubungi penjual jika perlu.
                        </div>
                    @else
                        {{-- ✅ Progress Bar (DITAMBAHKAN sesuai request kamu) --}}
                        <div class="mt-3">
                            <div class="h-2 w-full rounded-full bg-zinc-100 overflow-hidden">
                                <div class="h-full bg-black" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="mt-2 text-xs text-zinc-500">
                                Progress: {{ (int) $progress }}% • Update terakhir: {{ $order->updated_at->format('d M Y H:i') }}
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="mt-5 space-y-4">
                            @foreach ($keys as $idx => $key)
                                @php
                                    $label = $steps[$key];
                                    $active = $idx <= $orderStep;
                                    $current = $idx === $orderStep;
                                @endphp

                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex flex-col items-center">
                                        <div
                                            class="h-5 w-5 rounded-full border {{ $active ? 'bg-black border-black' : 'bg-white border-zinc-300' }}">
                                        </div>
                                        @if ($idx < count($steps) - 1)
                                            <div class="w-px h-10 {{ $active ? 'bg-black' : 'bg-zinc-200' }}"></div>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <div class="font-semibold {{ $active ? 'text-zinc-900' : 'text-zinc-500' }}">
                                            {{ $label }}
                                            @if ($current)
                                                <span
                                                    class="ml-2 text-xs px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">
                                                    Sekarang
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-xs text-zinc-500 mt-0.5">
                                            @if ($current)
                                                Status saat ini.
                                            @else
                                                &nbsp;
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 text-xs text-zinc-500">
                            * Status diupdate oleh penjual. Jika ada kendala, gunakan tombol <b>Chat Penjual</b>.
                        </div>
                    @endif
                </div>
            </div>

            {{-- KANAN: Pengiriman + Ringkasan --}}
            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit space-y-3">
                <div class="font-bold">Pengiriman</div>
                <div class="text-sm text-zinc-700">
                    <div class="font-semibold">{{ $order->receiver_name }}</div>
                    <div class="text-zinc-600">{{ $order->phone }}</div>
                    <div class="mt-2 whitespace-pre-line">{{ $order->address }}</div>
                </div>

                <div class="border-t border-zinc-200 pt-3 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Ongkir</span>
                        <span class="font-semibold">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-base">
                        <span class="font-bold">Total</span>
                        <span class="font-black">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if ($order->note)
                    <div class="text-sm">
                        <div class="font-semibold">Catatan</div>
                        <div class="text-zinc-600 whitespace-pre-line">{{ $order->note }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
