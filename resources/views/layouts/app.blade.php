<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Thrifty') }}</title>

    {{-- Bootstrap CSS (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind/Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-50">
    {{-- NAVIGATION (berisi sidebar + header + wrapper content) --}}
    @auth
        @if(auth()->user()->role === 'seller')
            @include('layouts.seller-navigation')
        @else
            @include('layouts.navigation')
        @endif
    @else
        @include('layouts.navigation')
    @endauth

    {{-- Bootstrap JS Bundle (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>