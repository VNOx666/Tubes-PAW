<div class="bg-white border-end d-flex flex-column"
     style="width:240px; min-height:100vh; position:sticky; top:0;">

    {{-- LOGO --}}
    <div class="p-4 border-bottom">
        <a href="{{ route('home') }}" class="text-decoration-none text-dark fw-bold fs-4">
            Thrifty
        </a>
    </div>

    {{-- MENU --}}
    <div class="flex-grow-1 p-3">
        <div class="list-group list-group-flush">

            <a href="{{ route('home') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('home') ? 'active' : '' }}">
                🏠 Home
            </a>

            <a href="{{ route('shop') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('shop') ? 'active' : '' }}">
                🛍️ Shop
            </a>

            <a href="{{ route('cart') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('cart*') ? 'active' : '' }}">
                🛒 Keranjang
            </a>

            <a href="{{ route('orders') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('orders*') ? 'active' : '' }}">
                📦 Pesanan
            </a>

            <a href="{{ route('chat') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('chat*') ? 'active' : '' }}">
                💬 Chat
            </a>

            <a href="{{ route('profile.edit') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('profile*') ? 'active' : '' }}">
                👤 Profil
            </a>

            {{-- KHUSUS SELLER --}}
            @if(auth()->user()->role === 'seller')
                <hr>
                <div class="text-muted small px-2 mb-2">Menu Penjual</div>

                <a href="{{ route('seller.dashboard') }}"
                   class="list-group-item list-group-item-action {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                    📊 Dashboard Seller
                </a>

                <a href="{{ route('seller.products.index') }}"
                   class="list-group-item list-group-item-action {{ request()->routeIs('seller.products*') ? 'active' : '' }}">
                    🧾 Produk Saya
                </a>

                <a href="{{ route('seller.orders.index') }}"
                   class="list-group-item list-group-item-action {{ request()->routeIs('seller.orders*') ? 'active' : '' }}">
                    📬 Order Masuk
                </a>

                <a href="{{ route('seller.chat') }}"
                   class="list-group-item list-group-item-action {{ request()->routeIs('seller.chat*') ? 'active' : '' }}">
                    💬 Chat Pembeli
                </a>
            @endif

        </div>
    </div>

    {{-- LOGOUT --}}
    <div class="p-3 border-top">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger w-100">
                Logout
            </button>
        </form>
    </div>
</div>
