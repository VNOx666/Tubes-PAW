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

<body class="bg-light">
    {{-- Navbar --}}
    @if (request()->is('seller*'))
        @include('layouts.seller-navigation')
    @else
        @include('layouts.navigation')
    @endif

    {{-- Optional Header --}}
    @hasSection('header')
        <header class="bg-white border-bottom">
            <div class="container py-3">
                @yield('header')
            </div>
        </header>
    @endif

    {{-- Main Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Bootstrap JS Bundle (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Close dropdown when clicking outside (for #userDropdown) --}}
    <script>
        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('userDropdown');
            if (!dropdown) return;

            // kalau klik di luar dropdown dan di luar tombol toggle
            if (!e.target.closest('#userDropdown') && !e.target.closest('[data-dropdown-toggle="userDropdown"]')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
