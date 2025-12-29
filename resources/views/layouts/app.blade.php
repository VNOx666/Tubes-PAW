<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Thrifty') }}</title>

    {{-- Bootstrap CSS (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Vite (opsional). Kalau kamu tidak pakai npm/vite, boleh comment/hapus --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    @include('layouts.navigation')

    {{-- Header opsional (kalau kamu pakai @section('header')) --}}
    @hasSection('header')
        <header class="bg-white border-bottom">
            <div class="container py-3">
                @yield('header')
            </div>
        </header>
    @endif

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Bootstrap JS Bundle (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
