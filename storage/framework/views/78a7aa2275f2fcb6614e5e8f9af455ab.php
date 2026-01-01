<?php $__env->startSection('content'); ?>
    <section class="grid lg:grid-cols-2 gap-6 items-center">
        <div class="space-y-5">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900 text-white text-xs">
                Thrift Shop Campus
            </div>

            <h1 class="text-4xl sm:text-5xl font-black leading-tight">
                Cari barang thrift yang <span class="underline decoration-emerald-400">unik</span>, bukan yang pasaran.
            </h1>

            <p class="text-zinc-600 text-lg">
                Temukan hoodie vintage, jaket kulit, denim rare, sampai aksesori — semua dari penjual thrifting terpercaya.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(route('shop')); ?>" class="px-5 py-3 rounded-2xl bg-black text-white shadow-soft hover:opacity-90">
                    Mulai Belanja
                </a>

                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'seller'): ?>
                        <a href="<?php echo e(route('seller.dashboard')); ?>"
                            class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                            Dashboard Penjual
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('seller.dashboard')); ?>"
                            class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                            Jual Barang Kamu
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>"
                        class="px-5 py-3 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                        Jual Barang Kamu
                    </a>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-3 gap-3 pt-4">
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">3K+</div>
                    <div class="text-xs text-zinc-600">Item siap checkout</div>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">4.8★</div>
                    <div class="text-xs text-zinc-600">Rating seller</div>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-zinc-200">
                    <div class="text-2xl font-black">24/7</div>
                    <div class="text-xs text-zinc-600">Chat & update status</div>
                </div>
            </div>
        </div>

        <div class="relative">
            
            <div class="rounded-3xl bg-gradient-to-br from-zinc-900 to-zinc-700 p-8 pb-20 shadow-soft text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs opacity-80">Rekomendasi hari ini</div>
                        <div class="text-2xl font-bold">Vintage Oversize Hoodie</div>
                    </div>
                    <div class="text-xs px-3 py-1 rounded-full bg-white/10 border border-white/20">Grade A</div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <?php $__currentLoopData = [['Hoodie Nike 90s', 'Rp 189.000'], ['Denim Jacket', 'Rp 249.000'], ['Cargo Pants', 'Rp 159.000'], ['Leather Bag', 'Rp 129.000']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('shop')); ?>"
                            class="rounded-2xl bg-white/10 border border-white/15 p-4 hover:bg-white/15">
                            <div class="text-sm font-semibold"><?php echo e($p[0]); ?></div>
                            <div class="text-xs opacity-80"><?php echo e($p[1]); ?></div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <div class="flex-1">
                        <div class="text-xs opacity-80">Status pengiriman</div>
                        <div class="font-semibold">Realtime tracking di halaman pesanan</div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'buyer'): ?>
                            <a href="<?php echo e(route('orders')); ?>" class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                                Lihat
                            </a>
                        <?php else: ?>
                            
                            <a href="<?php echo e(route('seller.orders.index')); ?>"
                                class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                                Lihat
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 rounded-xl bg-white text-black font-semibold">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            
            <div
                class="absolute bottom-[-40px] left-6 p-3 rounded-2xl bg-white border border-zinc-200 shadow-soft w-48 hidden sm:block z-10">


                <div class="text-xs text-zinc-700">Seller top minggu ini</div>
                <div class="font-semibold">ThriftKilat</div>
                <div class="text-xs text-zinc-700s">5.0 ★ • 1.2k transaksi</div>
            </div>
        </div>
    </section>

    
<section class="mt-10">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h2 class="text-2xl font-black">New Drop</h2>
            <p class="text-zinc-600">Barang baru masuk, cepat habis.</p>
        </div>

        <a href="<?php echo e(route('shop')); ?>" class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
            Lihat semua
        </a>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php $__empty_1 = true; $__currentLoopData = $newDrops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('product', $product->slug)); ?>"
                class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden hover:shadow-md transition">
                <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center overflow-hidden">
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-full h-full object-cover"
                            alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <span class="text-zinc-400">Foto Produk</span>
                    <?php endif; ?>
                </div>

                <div class="p-4">
                    <div class="flex items-center justify-between gap-2">
                        <div class="font-bold line-clamp-1"><?php echo e($product->name); ?></div>

                        <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                            Ready
                        </span>
                    </div>

                    <div class="text-sm text-zinc-600 mt-1">
                        <?php echo e($product->category ?? 'Tanpa kategori'); ?>

                        <?php if($product->grade): ?>
                            • Grade <?php echo e($product->grade); ?>

                        <?php endif; ?>
                    </div>

                    <div class="mt-3 text-lg font-black">
                        Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                    </div>

                    <div class="mt-2 text-sm text-zinc-600">
                        Seller: <?php echo e($product->seller->name ?? 'Seller'); ?>

                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full p-6 rounded-3xl bg-white border border-zinc-200 text-zinc-600">
                Belum ada produk yang dijual. Seller bisa mulai dari menu <b>Mode Seller</b> → <b>Tambah Produk</b>.
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Thrifty Shop Campus — Thrifting Marketplace'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/home.blade.php ENDPATH**/ ?>