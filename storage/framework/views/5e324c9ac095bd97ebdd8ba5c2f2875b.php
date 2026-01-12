<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-black">Chat</h1>
        <p class="text-zinc-600">Percakapan buyer & seller berdasarkan pesanan.</p>

        <div class="mt-6 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
            <?php if($conversations->count() === 0): ?>
                <div class="p-6 text-zinc-600">Belum ada percakapan. Buat order dulu lalu buka chat.</div>
            <?php else: ?>
                <div class="divide-y divide-zinc-200">
                    <?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('chat.show', $c)); ?>" class="block p-4 hover:bg-zinc-50">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="font-bold">Order: <?php echo e($c->order->code); ?></div>
                                    <div class="text-sm text-zinc-600">
                                        Buyer: <?php echo e($c->buyer->name); ?> • Seller: <?php echo e($c->seller->name); ?>

                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                                    Buka
                                </span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/chat/index.blade.php ENDPATH**/ ?>