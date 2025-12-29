@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-black">Beri Rating</h1>
        <p class="text-zinc-600">Order: {{ $order->code }}</p>

        @if (session('error'))
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('reviews.store', $order) }}"
            class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 space-y-4">
            @csrf

            <div>
                <label class="text-sm font-semibold">Rating (1-5)</label>
                <select name="rating" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-white px-3 py-2" required>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">Komentar (opsional)</label>
                <textarea name="comment" rows="4" class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                    placeholder="Ceritakan pengalaman belanja kamu..."></textarea>
            </div>

            <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                Kirim Rating
            </button>
        </form>
    </div>
@endsection
