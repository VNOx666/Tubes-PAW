<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-black">Pesanan Masuk</h1>
                <p class="text-zinc-600">Kelola status pengiriman untuk pesanan yang berisi produk kamu.</p>
            </div>
            <a href="<?php echo e(route('seller.dashboard')); ?>"
                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Dashboard
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <?php if($orders->count() === 0): ?>
                <div class="p-6 text-zinc-600">Belum ada pesanan untuk produk kamu.</div>
            <?php else: ?>
                <div class="divide-y divide-zinc-200">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('seller.orders.show', $o)); ?>" class="block p-4 hover:bg-zinc-50">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="font-bold"><?php echo e($o->code); ?></div>
                                    <div class="text-sm text-zinc-600">
                                        Buyer: <?php echo e($o->user->name); ?> • <?php echo e($o->created_at->format('d M Y H:i')); ?>

                                    </div>
                                    <div class="text-xs text-zinc-500 mt-1">
                                        Item kamu: <?php echo e($o->items->count()); ?> • Total order: Rp
                                        <?php echo e(number_format($o->total, 0, ',', '.')); ?>

                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                                    <?php echo e(strtoupper($o->status)); ?>

                                </span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="p-4">
                    <?php echo e($orders->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/seller/orders/index.blade.php ENDPATH**/ ?>