{{-- resources/views/layouts/navigation.blade.php --}}
@php
    use Illuminate\Support\Facades\Route;

    // helper: pilih route pertama yang ada
    $pickRoute = function (array $names, string $fallback = '#') {
        foreach ($names as $n) {
            if (Route::has($n)) return route($n);
        }
        return $fallback;
    };

    // helper: cek active untuk beberapa nama route
    $isActiveAny = function (array $names) {
        foreach ($names as $n) {
            try {
                if (Route::has($n) && request()->routeIs($n)) return true;
            } catch (\Throwable $e) {}
        }
        return false;
    };

    // ====== MENU BUYER ======
    // kamu bisa tambah/kurangi di sini tanpa takut href '#'
    $items = [
        [
            'title' => 'Home',
            'routes' => ['home'],
            'icon' => 'home',
        ],
        [
            'title' => 'Shop',
            'routes' => ['shop', 'products.index'],
            'icon' => 'bag',
        ],
        [
            'title' => 'Keranjang',
            'routes' => ['cart', 'cart.index'],
            'icon' => 'cart',
        ],
        [
            'title' => 'Pesanan',
            'routes' => ['orders.index', 'orders'],
            'icon' => 'receipt',
        ],
        [
            'title' => 'Chat',
            'routes' => ['chat', 'chat.index'],
            'icon' => 'chat',
        ],
        [
            'title' => 'Profil',
            'routes' => ['profile', 'profile.edit', 'profile.show'],
            'icon' => 'user',
            'auth_only' => true, // kalau belum login, nanti diarahkan ke login
        ],
    ];
@endphp

<div class="min-h-screen bg-zinc-50">
    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 w-[84px] bg-white border-r border-zinc-200 z-50">
        {{-- Brand: hanya logo --}}
        <div class="h-[72px] flex items-center justify-center border-b border-zinc-200">
            <a href="{{ Route::has('home') ? route('home') : '/' }}"
               class="h-11 w-11 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                T
            </a>
        </div>

        {{-- Menu icons --}}
        <nav class="py-4 flex flex-col items-center gap-3">
            @foreach($items as $it)
                @php
                    $active = $isActiveAny($it['routes']);

                    // kalau item butuh login dan user guest → lempar ke login
                    if (($it['auth_only'] ?? false) && auth()->guest()) {
                        $href = Route::has('login') ? route('login') : '#';
                    } else {
                        $href = $pickRoute($it['routes'], '#');
                    }
                @endphp

                <a href="{{ $href }}"
                   title="{{ $it['title'] }}"
                   class="h-12 w-12 rounded-2xl flex items-center justify-center transition cursor-pointer
                        {{ $active ? 'bg-zinc-900 text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' }}">
                    {{-- ICONS --}}
                    @if($it['icon'] === 'home')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-10.5z"/>
                        </svg>

                    @elseif($it['icon'] === 'bag')
                        {{-- shopping bag (lebih cocok buat thrifting, bukan kotak) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 8h12l-1 13H7L6 8z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 8a3 3 0 0 1 6 0"/>
                        </svg>

                    @elseif($it['icon'] === 'cart')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3h2l2.2 11.2A2 2 0 0 0 9.2 16H18a2 2 0 0 0 2-1.6l1-6.4H7"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>

                    @elseif($it['icon'] === 'receipt')
                        {{-- receipt / orders (bukan grid kotak) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 3h10v18l-2-1-2 1-2-1-2 1-2-1-2 1V3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 8h6M9 12h6M9 16h4"/>
                        </svg>

                    @elseif($it['icon'] === 'chat')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 10h8M8 14h5M21 12c0 4.418-4.03 8-9 8a10.6 10.6 0 0 1-4-.77L3 20l1.2-3.6A7.6 7.6 0 0 1 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>

                    @elseif($it['icon'] === 'user')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20 21a8 8 0 0 0-16 0"/>
                        </svg>
                    @endif
                </a>

                @if($loop->index === 2)
                    <div class="w-10 h-px bg-zinc-200 my-1"></div>
                @endif
            @endforeach
        </nav>
    </aside>

    {{-- AREA KANAN --}}
    <div class="pl-[84px]">
        {{-- TOP BAR --}}
        <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
            <div class="h-[72px] px-6 flex items-center justify-between gap-4">
                <div class="font-black text-zinc-900 text-lg">Thrifty</div>

                <form action="{{ Route::has('shop') ? route('shop') : (Route::has('products.index') ? route('products.index') : '#') }}"
                      class="hidden md:block">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z"/>
                            </svg>
                        </span>
                        <input name="q" placeholder="Search..."
                               class="pl-10 pr-16 py-2 rounded-2xl border border-zinc-200 bg-zinc-50 text-sm w-[320px] focus:outline-none focus:ring-2 focus:ring-zinc-200">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[11px] text-zinc-400 border border-zinc-200 rounded-lg px-2 py-1 bg-white">
                            Ctrl K
                        </span>
                    </div>
                </form>

                @guest
                    <a href="{{ Route::has('login') ? route('login') : '#' }}"
                       class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Login
                    </a>
                @endguest
            </div>
        </header>

        {{-- CONTENT --}}
        <main>
            <div class="px-6 py-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>