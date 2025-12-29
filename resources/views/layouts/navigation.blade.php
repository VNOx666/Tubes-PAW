<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded bg-dark text-white"
                  style="width:36px;height:36px;">T</span>
            <span class="fw-bold">Thrifty</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('shop')) active @endif" href="{{ route('shop') }}">Shop</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('dashboard')) active @endif"
                           href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    @if(auth()->user()->role === 'buyer')
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('shop')) active @endif" href="{{ route('shop') }}">Shop</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('cart*')) active @endif" href="{{ route('cart') }}">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('orders*')) active @endif" href="{{ route('orders') }}">Pesanan</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('chat*')) active @endif" href="{{ route('chat') }}">Chat</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('seller.dashboard')) active @endif" href="{{ route('seller.dashboard') }}">Dashboard Seller</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('seller.products*')) active @endif" href="{{ route('seller.products.index') }}">Produk</a></li>

                        {{-- kalau route seller orders belum ada, comment dulu 3 baris ini --}}
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('seller.orders*')) active @endif" href="{{ route('seller.orders.index') }}">Orders</a></li>

                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('seller.chat*')) active @endif" href="{{ route('seller.chat') }}">Chat</a></li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-2">
                @guest
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-dark btn-sm" href="{{ route('register') }}">Register</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
