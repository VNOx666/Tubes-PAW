@extends('layouts.app', ['title' => 'Daftar — Thrifty'])

@section('content')
    <div class="max-w-md mx-auto rounded-3xl bg-white border border-zinc-200 shadow-soft p-6">
        <h1 class="text-2xl font-black">Daftar</h1>
        <p class="text-zinc-600 text-sm">Buat akun untuk mulai thrifting.</p>

        <div class="mt-5 space-y-3">
            <input class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-3" placeholder="Nama" />
            <input class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-3" placeholder="Email" />
            <input type="password" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-3"
                placeholder="Password" />
            <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">Buat Akun</button>
        </div>

        <div class="mt-4 text-sm text-zinc-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-black hover:underline">Login</a>
        </div>
    </div>
@endsection
