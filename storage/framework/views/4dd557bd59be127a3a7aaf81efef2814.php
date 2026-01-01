<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(route('home')); ?>">
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
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('home')): ?> active <?php endif; ?>" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('shop')): ?> active <?php endif; ?>" href="<?php echo e(route('shop')); ?>">Shop</a>
                    </li>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('dashboard')): ?> active <?php endif; ?>"
                           href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>

                    <?php if(auth()->user()->role === 'buyer'): ?>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('shop')): ?> active <?php endif; ?>" href="<?php echo e(route('shop')); ?>">Shop</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('cart*')): ?> active <?php endif; ?>" href="<?php echo e(route('cart')); ?>">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('orders*')): ?> active <?php endif; ?>" href="<?php echo e(route('orders')); ?>">Pesanan</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('chat*')): ?> active <?php endif; ?>" href="<?php echo e(route('chat')); ?>">Chat</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('seller.dashboard')): ?> active <?php endif; ?>" href="<?php echo e(route('seller.dashboard')); ?>">Dashboard Seller</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('seller.products*')): ?> active <?php endif; ?>" href="<?php echo e(route('seller.products.index')); ?>">Produk</a></li>

                        
                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('seller.orders*')): ?> active <?php endif; ?>" href="<?php echo e(route('seller.orders.index')); ?>">Orders</a></li>

                        <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('seller.chat*')): ?> active <?php endif; ?>" href="<?php echo e(route('seller.chat')); ?>">Chat</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <?php if(auth()->guard()->guest()): ?>
                    <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('login')); ?>">Login</a>
                    <a class="btn btn-dark btn-sm" href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo e(auth()->user()->name); ?>

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>