<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-black">Pesanan Saya</h1>
        <p class="text-zinc-600">Tracking status pesanan kamu.</p>

        <?php if(session('success')): ?>
            <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <?php if($orders->count() === 0): ?>
                <div class="p-6 text-zinc-600">Belum ada pesanan.</div>
            <?php else: ?>
                <div class="divide-y divide-zinc-200">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('orders.detail', $o)); ?>" class="block p-4 hover:bg-zinc-50">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="font-bold"><?php echo e($o->code); ?></div>
                                    <div class="text-sm text-zinc-600">
                                        <?php echo e($o->created_at->format('d M Y H:i')); ?> • Total Rp
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/orders.blade.php ENDPATH**/ ?>