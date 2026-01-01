<?php $__env->startSection('content'); ?>
    <div class="flex flex-col lg:flex-row gap-6">
        
        <aside class="lg:w-72 space-y-4">
            <div class="rounded-3xl bg-white border border-zinc-200 p-4 shadow-soft">
                <div class="font-bold mb-3">Filter</div>

                <label class="text-xs text-zinc-600">Kategori</label>
                <select class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2">
                    <option>Semua</option>
                    <option>Hoodie</option>
                    <option>Jacket</option>
                    <option>Jeans</option>
                    <option>Tas</option>
                </select>

                <div class="mt-3 grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs text-zinc-600">Min</label>
                        <input class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                            placeholder="50k" />
                    </div>
                    <div>
                        <label class="text-xs text-zinc-600">Max</label>
                        <input class="w-full mt-1 rounded-2xl border border-zinc-200 bg-zinc-50 px-3 py-2"
                            placeholder="300k" />
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-xs text-zinc-600">Grade</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <?php $__currentLoopData = ['A', 'B', 'C']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button"
                                class="px-3 py-1 rounded-full border border-zinc-200 bg-white hover:bg-zinc-50 text-sm">
                                <?php echo e($g); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <button type="button"
                    class="mt-4 w-full px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
                    Terapkan
                </button>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 p-4 shadow-soft">
                <div class="font-bold">Tips Thrifting</div>
                <p class="text-sm text-zinc-600 mt-2">
                    Cek ukuran, detail noda, dan selalu chat penjual untuk foto tambahan.
                </p>
            </div>
        </aside>

        
        <section class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-black">Shop</h1>
                    <p class="text-zinc-600 text-sm">
                        Hasil pencarian:
                        <span class="font-semibold">“<?php echo e($q ?? 'Semua'); ?>”</span>
                    </p>
                </div>

                <div class="flex gap-2">
                    <select class="rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                        <option>Terbaru</option>
                        <option>Termurah</option>
                        <option>Termahal</option>
                        <option>Rating Seller</option>
                    </select>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'buyer'): ?>
                            <a href="<?php echo e(route('cart')); ?>"
                                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                                Keranjang
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('seller.orders.index')); ?>"
                                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                                Mode Seller
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $seller = $product->seller ?? null;
                        $avg = $seller ? round($seller->averageRating(), 1) : 0;
                        $cnt = $seller ? $seller->ratingCount() : 0;
                    ?>

                    <a href="<?php echo e(route('product', $product->slug)); ?>"
                        class="group rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden hover:-translate-y-0.5 transition">
                        <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center text-zinc-400 overflow-hidden">
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"
                                    class="h-full w-full object-cover" />
                            <?php else: ?>
                                <span class="text-sm">Foto Produk</span>
                            <?php endif; ?>
                        </div>

                        <div class="p-4">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="font-bold group-hover:underline"><?php echo e($product->name); ?></div>
                                    <div class="text-xs text-zinc-600">
                                        <?php echo e($product->category ?? 'Unisex'); ?>

                                        <?php if($product->grade): ?> • Grade <?php echo e($product->grade); ?> <?php endif; ?>
                                        <?php if($product->size): ?> • Size <?php echo e($product->size); ?> <?php endif; ?>
                                    </div>
                                </div>

                                <?php if($product->quantity > 0): ?>
                                    <div class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">Ready</div>
                                <?php else: ?>
                                    <div class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">Habis</div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-3 font-black">
                                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </div>

                            <div class="mt-2 text-xs text-zinc-500">
                                Seller:
                                <?php if($seller): ?>
                                    <a href="<?php echo e(route('seller.profile', $seller)); ?>"
                                        class="underline hover:no-underline font-semibold">
                                        <?php echo e($seller->name); ?>

                                    </a>
                                    • <?php echo e($avg); ?>★
                                    <span class="text-zinc-400">(<?php echo e($cnt); ?>)</span>
                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full p-6 rounded-3xl bg-white border border-zinc-200 text-zinc-600">
                        Produk tidak ditemukan.
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="mt-6">
                <?php echo e($products->links()); ?>

            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Shop — Thrifty'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/shop.blade.php ENDPATH**/ ?>