<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Thrifty') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50">

    {{-- NAVBAR GUEST --}}
    <nav class="bg-white border-b border-zinc-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
                    <div class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                        T
                    </div>
                    <div class="font-black text-xl text-zinc-900">Thrifty</div>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto">
                <div class="bg-white border border-zinc-200 shadow-soft rounded-3xl p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

</body>
</html>
