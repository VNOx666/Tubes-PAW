@php
    $user = auth()->user();
    $role = $user->role ?? null;

    // helper: active state
    $is = fn ($pattern) => request()->is($pattern);

    // item builder
    $item = function ($href, $label, $icon, $active = false) {
        $base = "group relative flex items-center justify-center w-11 h-11 rounded-2xl transition";
        $cls  = $active
            ? "bg-zinc-900 text-white shadow-sm"
            : "text-zinc-700 hover:bg-zinc-100";
        return [
            'href' => $href,
            'label' => $label,
            'icon' => $icon,
            'class' => $base . " " . $cls,
        ];
    };

    // ICONS (inline SVG biar ga perlu install library)
    $icons = [
        'home' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V21a.75.75 0 0 1-.75.75H3.75A.75.75 0 0 1 3 21v-10.5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/></svg>',
        'shop' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18l-1.5 14.25A1.5 1.5 0 0 1 18 22H6a1.5 1.5 0 0 1-1.5-1.75L3 7Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 7a4 4 0 0 1 8 0"/></svg>',
        'cart' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l1.5 13.5h13.5l2.25-9H6.75"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 21a.75.75 0 1 0 0-1.5A.75.75 0 0 0 9 21Zm9 0a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/></svg>',
        'orders' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7.5 3.75h9A1.5 1.5 0 0 1 18 5.25v15A1.5 1.5 0 0 1 16.5 21h-9A1.5 1.5 0 0 1 6 20.25v-15A1.5 1.5 0 0 1 7.5 3.75Z"/></svg>',
        'chat' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 12c0 4.556-4.03 8.25-9 8.25-1.245 0-2.43-.2-3.51-.565L3.75 21l1.215-3.24A7.84 7.84 0 0 1 3.75 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>',
        'grid' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5h6.75v6.75H4.5V4.5Zm8.25 0H19.5v6.75h-6.75V4.5ZM4.5 12.75h6.75v6.75H4.5v-6.75Zm8.25 0H19.5v6.75h-6.75v-6.75Z"/></svg>',
        'plus' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>',
        'user' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"/></svg>',
        'settings' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h3m-8.25 6h.75m12 0h.75M10.5 18h3M8.25 6.75l.53-.53a2.25 2.25 0 0 1 3.182 0l.036.036a2.25 2.25 0  remind=" " /></svg>',
    ];

    // MENU utama (buyer & guest)
    $main = [];
    $main[] = $item(route('home'), 'Home', $icons['home'], $is('/'));
    $main[] = $item(route('shop'), 'Shop', $icons['shop'], $is('shop*'));

    if ($user && $role === 'buyer') {
        $main[] = $item(route('cart'), 'Keranjang', $icons['cart'], $is('cart*'));
        $main[] = $item(route('orders'), 'Pesanan', $icons['orders'], $is('orders*'));
        $main[] = $item(route('chat'), 'Chat', $icons['chat'], $is('chat*'));
    }

    // MENU seller (muncul kalau role seller ATAU sedang di /seller)
    $isSellerArea = request()->is('seller*') || ($user && $role === 'seller');
    $seller = [];

    if ($isSellerArea) {
        $seller[] = $item(route('seller.dashboard'), 'Dashboard Seller', $icons['grid'], $is('seller'));
        $seller[] = $item(route('seller.products.index'), 'Produk Saya', $icons['plus'], $is('seller/products*'));
        $seller[] = $item(route('seller.orders.index'), 'Order Masuk', $icons['orders'], $is('seller/orders*'));
        $seller[] = $item(route('seller.chat'), 'Chat Pembeli', $icons['chat'], $is('seller/chat*'));
    }
@endphp

{{-- Sidebar fixed ala Pinterest --}}
<aside class="fixed left-0 top-0 h-screen w-[86px] bg-white border-r border-zinc-200 z-50">
    <div class="h-full flex flex-col items-center py-5">

        {{-- Brand/Logo --}}
        <a href="{{ route('home') }}"
           class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
            T
        </a>

        {{-- menu utama --}}
        <div class="mt-6 flex flex-col gap-3">
            @foreach($main as $m)
                <a href="{{ $m['href'] }}" class="{{ $m['class'] }}">
                    {!! $m['icon'] !!}
                    <span class="pointer-events-none opacity-0 group-hover:opacity-100 transition
                                absolute left-[92px] whitespace-nowrap text-sm bg-zinc-900 text-white
                                px-3 py-2 rounded-xl shadow">
                        {{ $m['label'] }}
                    </span>
                </a>
            @endforeach
        </div>

        {{-- divider --}}
        @if(count($seller))
            <div class="w-10 h-px bg-zinc-200 my-6"></div>

            <div class="flex flex-col gap-3">
                @foreach($seller as $m)
                    <a href="{{ $m['href'] }}" class="{{ $m['class'] }}">
                        {!! $m['icon'] !!}
                        <span class="pointer-events-none opacity-0 group-hover:opacity-100 transition
                                    absolute left-[92px] whitespace-nowrap text-sm bg-zinc-900 text-white
                                    px-3 py-2 rounded-xl shadow">
                            {{ $m['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif

        <div class="flex-1"></div>

        {{-- bottom actions --}}
        <div class="flex flex-col gap-3 pb-2">
            @auth
                <a href="{{ route('profile.edit') }}"
                   class="group relative flex items-center justify-center w-11 h-11 rounded-2xl text-zinc-700 hover:bg-zinc-100">
                    {!! $icons['user'] !!}
                    <span class="pointer-events-none opacity-0 group-hover:opacity-100 transition
                                absolute left-[92px] whitespace-nowrap text-sm bg-zinc-900 text-white
                                px-3 py-2 rounded-xl shadow">
                        Profil
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group relative flex items-center justify-center w-11 h-11 rounded-2xl text-zinc-700 hover:bg-zinc-100">
                        {{-- icon logout --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9l3 3-3 3m3-3H8.25"/>
                        </svg>
                        <span class="pointer-events-none opacity-0 group-hover:opacity-100 transition
                                    absolute left-[92px] whitespace-nowrap text-sm bg-zinc-900 text-white
                                    px-3 py-2 rounded-xl shadow">
                            Logout
                        </span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="group relative flex items-center justify-center w-11 h-11 rounded-2xl text-zinc-700 hover:bg-zinc-100">
                    {!! $icons['user'] !!}
                    <span class="pointer-events-none opacity-0 group-hover:opacity-100 transition
                                absolute left-[92px] whitespace-nowrap text-sm bg-zinc-900 text-white
                                px-3 py-2 rounded-xl shadow">
                        Login
                    </span>
                </a>
            @endauth
        </div>
    </div>
</aside>
