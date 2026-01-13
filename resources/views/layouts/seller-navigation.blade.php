{{-- resources/views/layouts/seller-navigation.blade.php --}}
@php
    $items = [
        ['route' => 'seller.dashboard',       'icon' => 'home',     'title' => 'Dashboard'],
        ['route' => 'seller.products.index',  'icon' => 'grid',     'title' => 'Produk Saya'],
        ['route' => 'seller.products.create', 'icon' => 'plus',     'title' => 'Tambah Produk'],
        ['route' => 'seller.orders.index',    'icon' => 'doc',      'title' => 'Order Masuk'],
        ['route' => 'seller.chat',            'icon' => 'chat',     'title' => 'Chat Pembeli'],
    ];

    $routeExists = fn($name) => \Route::has($name);

    $isActive = function ($routeName) {
        try {
            if (!\Route::has($routeName)) return false;
            return request()->routeIs($routeName) || request()->routeIs($routeName . '.*');
        } catch (\Throwable $e) {
            return false;
        }
    };
@endphp

<div class="min-h-screen bg-zinc-50">
    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 w-[84px] bg-white border-r border-zinc-200 z-50">
        {{-- Logo (hanya 1, di sidebar) --}}
        <div class="h-[72px] flex items-center justify-center border-b border-zinc-200">
            <a href="{{ $routeExists('seller.dashboard') ? route('seller.dashboard') : '/' }}"
               class="h-12 w-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black text-lg">
                T
            </a>
        </div>

        {{-- Menu --}}
        <nav class="py-4 flex flex-col items-center gap-3">
            @foreach($items as $it)
                @php
                    $active = $isActive($it['route']);
                    $href = $routeExists($it['route']) ? route($it['route']) : '#';
                @endphp

                <a href="{{ $href }}"
                   title="{{ $it['title'] }}"
                   class="h-12 w-12 rounded-2xl flex items-center justify-center transition
                        {{ $active ? 'bg-zinc-900 text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' }}">
                    @if($it['icon'] === 'home')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-10.5z"/>
                        </svg>
                    @elseif($it['icon'] === 'grid')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h7v7H4V4zm9 0h7v7h-7V4zM4 13h7v7H4v-7zm9 0h7v7h-7v-7z"/>
                        </svg>
                    @elseif($it['icon'] === 'plus')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
                        </svg>
                    @elseif($it['icon'] === 'doc')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h7l3 3v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z"/>
                        </svg>
                    @elseif($it['icon'] === 'chat')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5M21 12c0 4.418-4.03 8-9 8a10.6 10.6 0 0 1-4-.77L3 20l1.2-3.6A7.6 7.6 0 0 1 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    @endif
                </a>

                @if($loop->index === 2)
                    <div class="w-10 h-px bg-zinc-200 my-1"></div>
                @endif
            @endforeach
        </nav>

        {{-- Bottom: profile + logout --}}
        <div class="absolute bottom-4 left-0 w-full flex flex-col items-center gap-3">
            {{-- Profile seller (pakai seller.profile/{user}) --}}
            @if(\Route::has('seller.profile'))
                <a href="{{ route('seller.profile', auth()->id()) }}"
                   title="Profil"
                   class="h-12 w-12 rounded-2xl flex items-center justify-center text-zinc-600 hover:bg-zinc-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 0 0-16 0"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 13a4 4 0 1 0-4-4 4 4 0 0 0 4 4z"/>
                    </svg>
                </a>
            @endif

            {{-- Logout --}}
            @if(\Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        title="Logout"
                        class="h-12 w-12 rounded-2xl flex items-center justify-center text-zinc-600 hover:bg-zinc-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3"/>
                        </svg>
                    </button>
                </form>
            @endif
        </div>
    </aside>

    {{-- TOP BAR (KONTEN KANAN) --}}
    <header class="sticky top-0 z-40 bg-white border-b border-zinc-200" style="margin-left:84px;">
        <div class="h-[72px] px-6 flex items-center justify-between">
            <div class="font-black text-zinc-900 text-lg">
                Seller
            </div>

            {{-- optional search / kosong aja --}}
            <div class="text-sm text-zinc-500">
                {{ auth()->user()->name ?? '' }}
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main style="margin-left:84px;">
        <div class="px-6 py-6">
            @yield('content')
        </div>
    </main>
</div>