@extends('layouts.app', ['title' => 'Chat — Thrifty'])

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">
        <aside class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="p-4 border-b border-zinc-200">
                <div class="font-bold">Inbox</div>
                <div class="text-xs text-zinc-500">Chat pembeli & penjual</div>
            </div>
            <div class="divide-y divide-zinc-200">
                @foreach (['ThriftKilat', 'VintageHub', 'DenimRoom'] as $u)
                    <a class="block p-4 hover:bg-zinc-50" href="#">
                        <div class="font-semibold">{{ $u }}</div>
                        <div class="text-xs text-zinc-500">“ready kak, bisa nego tipis…”</div>
                    </a>
                @endforeach
            </div>
        </aside>

        <section
            class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden flex flex-col">
            <div class="p-4 border-b border-zinc-200 flex items-center justify-between">
                <div>
                    <div class="font-bold">ThriftKilat</div>
                    <div class="text-xs text-zinc-500">online • balas cepat</div>
                </div>
                <a href="{{ route('orders') }}"
                    class="px-3 py-2 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">Lihat Pesanan</a>
            </div>

            <div class="p-4 flex-1 space-y-3 bg-zinc-50">
                <div class="max-w-md rounded-2xl bg-white border border-zinc-200 p-3">
                    Kak ini hoodie masih ada?
                </div>
                <div class="max-w-md rounded-2xl bg-black text-white p-3 ml-auto">
                    Masih kak, grade A. Mau size berapa?
                </div>
                <div class="max-w-md rounded-2xl bg-white border border-zinc-200 p-3">
                    L kak. Bisa foto detail noda?
                </div>
            </div>

            <div class="p-4 border-t border-zinc-200">
                <form class="flex gap-2">
                    <input class="flex-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3"
                        placeholder="Tulis pesan..." />
                    <button class="px-5 py-3 rounded-2xl bg-black text-white hover:opacity-90">Kirim</button>
                </form>
            </div>
        </section>
    </div>
@endsection
