<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-zinc-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center gap-4">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-black text-white">T</span>
            <span>Thrifty</span>
            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">
                Thrifting
            </span>
        </a>

        <!-- Search -->
        <div class="flex-1 hidden md:block">
            <form action="{{ route('shop') }}" class="relative">
                <input
                    name="q"
                    placeholder="Cari hoodie, jeans, vintage..."
                    class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                />
                <span class="absolute left-3 top-2.5 text-zinc-400">⌕</span>
            </form>
        </div>

        <!-- Navigation -->
        <nav class="flex items-center gap-2">

            <a href="{{ route('shop') }}" class="px-3 py-2 rounded-xl hover:bg-zinc-100">
                Shop
            </a>

            @auth
                {{-- Buyer menu --}}
                @if(auth()->user()->isBuyer())
                    <a href="{{ route('orders') }}" class="px-3 py-2 rounded-xl hover:bg-zinc-100 hidden sm:block">
                        Pesanan
                    </a>

                    <a href="{{ route('chat') }}" class="px-3 py-2 rounded-xl hover:bg-zinc-100 hidden sm:block">
                        Chat
                    </a>

                    <a href="{{ route('cart') }}" class="relative px-3 py-2 rounded-xl hover:bg-zinc-100">
                        Keranjang
                        <span class="absolute -top-1 -right-1 text-xs bg-black text-white rounded-full px-2 py-0.5">
                            2
                        </span>
                    </a>
                @endif

                <div class="h-6 w-px bg-zinc-200 mx-1"></div>

                {{-- Seller menu --}}
                @if(auth()->user()->isSeller())
                    <a
                        href="{{ route('seller.dashboard') }}"
                        class="px-3 py-2 rounded-xl bg-black text-white hover:opacity-90"
                    >
                        Dashboard Penjual
                    </a>
                @endif

                {{-- Profile --}}
                <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-xl hover:bg-zinc-100">
                    Akun
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-3 py-2 rounded-xl hover:bg-zinc-100">
                        Logout
                    </button>
                </form>

            @else
                {{-- Guest --}}
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-xl hover:bg-zinc-100">
                    Login
                </a>
            @endauth
        </nav>
    </div>
</header>
