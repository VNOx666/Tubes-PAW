<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <div class="aspect-[4/3] bg-zinc-100 flex items-center justify-center overflow-hidden">
                <?php if(!empty($product->image)): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                        class="w-full h-full object-cover"
                        alt="<?php echo e($product->name); ?>">
                <?php else: ?>
                    <span class="text-zinc-400">Foto Produk</span>
                <?php endif; ?>
            </div>

            
            <div class="p-4 flex gap-3">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="h-16 w-16 rounded-2xl bg-zinc-100 border border-zinc-200 flex items-center justify-center text-xs text-zinc-400">
                        foto
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        
        <div>
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-black"><?php echo e($product->name); ?></h1>
                    <p class="text-zinc-600 mt-1">
                        <?php echo e($product->category ?? 'Tanpa kategori'); ?>

                        <?php if($product->grade): ?> • Grade <?php echo e($product->grade); ?> <?php endif; ?>
                        <?php if($product->size): ?> • Ukuran <?php echo e($product->size); ?> <?php endif; ?>
                    </p>
                </div>

                <span class="text-xs px-3 py-1 rounded-full
                    <?php echo e($product->quantity > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-200 text-zinc-700'); ?>">
                    <?php echo e($product->quantity > 0 ? 'Ready' : 'Sold'); ?>

                </span>
            </div>

            <div class="mt-4 rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-sm text-zinc-600">Harga</div>
                        <div class="text-3xl font-black">
                            Rp <?php echo e(number_format((int) $product->price, 0, ',', '.')); ?>

                        </div>
                    </div>

                    <div class="text-right text-sm text-zinc-700">
                        <div>Seller: <b><?php echo e($product->seller->name ?? 'Seller'); ?></b></div>
                    </div>
                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-3">
                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="flex-1">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                            + Keranjang
                        </button>
                    </form>

                    <a href="<?php echo e(route('checkout')); ?>"
                        class="flex-1 text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Beli Sekarang
                    </a>
                </div>

                <a href="<?php echo e(route('chat')); ?>"
                    class="mt-3 block text-center px-4 py-3 rounded-2xl bg-zinc-900 text-white hover:opacity-90">
                    Chat Penjual
                </a>
            </div>

            <div class="mt-5 rounded-3xl bg-white border border-zinc-200 shadow-soft p-5">
                <h3 class="font-black text-lg">Deskripsi</h3>
                <div class="mt-2 text-zinc-700 leading-relaxed whitespace-pre-line">
                    <?php echo e($product->description ?: 'Tidak ada deskripsi.'); ?>

                </div>

                <div class="mt-4 text-sm text-zinc-600">
                    Warna: <?php echo e($product->color ?? '-'); ?> • Stok: <?php echo e($product->quantity ?? 0); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => ($product->name ?? 'Detail Produk') . ' — Thrifty'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/product.blade.php ENDPATH**/ ?>