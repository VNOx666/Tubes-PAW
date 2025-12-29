@extends('layouts.app', ['title' => 'Profil Seller'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-black">{{ $user->name }}</h1>
                    <p class="text-zinc-600 text-sm">Seller Thrifty</p>

                    <div
                        class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                        {{ $avg }}★ <span class="text-emerald-800/60">({{ $cnt }} ulasan)</span>
                    </div>
                </div>

                <a href="{{ route('shop') }}" class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Kembali ke Shop
                </a>
            </div>

            <div class="mt-6">
                <h2 class="font-bold">Ulasan Pembeli</h2>

                @if ($user->receivedReviews->count() === 0)
                    <div class="mt-3 text-zinc-600">Belum ada ulasan.</div>
                @else
                    <div class="mt-3 space-y-3">
                        @foreach ($user->receivedReviews->sortByDesc('created_at') as $r)
                            <div class="p-4 rounded-2xl border border-zinc-200 bg-zinc-50">
                                <div class="flex items-center justify-between">
                                    <div class="font-semibold">{{ $r->buyer->name ?? 'Buyer' }}</div>
                                    <div class="text-sm font-bold">{{ $r->rating }}★</div>
                                </div>

                                @if ($r->comment)
                                    <div class="mt-2 text-zinc-700">{{ $r->comment }}</div>
                                @endif

                                <div class="mt-2 text-xs text-zinc-500">{{ $r->created_at->format('d M Y') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
