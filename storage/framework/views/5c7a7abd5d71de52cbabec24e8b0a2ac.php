<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-black"><?php echo e($user->name); ?></h1>
                    <p class="text-zinc-600 text-sm">Seller Thrifty</p>

                    <div
                        class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                        <?php echo e($avg); ?>★ <span class="text-emerald-800/60">(<?php echo e($cnt); ?> ulasan)</span>
                    </div>
                </div>

                <a href="<?php echo e(route('shop')); ?>" class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Kembali ke Shop
                </a>
            </div>

            <div class="mt-6">
                <h2 class="font-bold">Ulasan Pembeli</h2>

                <?php if($user->receivedReviews->count() === 0): ?>
                    <div class="mt-3 text-zinc-600">Belum ada ulasan.</div>
                <?php else: ?>
                    <div class="mt-3 space-y-3">
                        <?php $__currentLoopData = $user->receivedReviews->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 rounded-2xl border border-zinc-200 bg-zinc-50">
                                <div class="flex items-center justify-between">
                                    <div class="font-semibold"><?php echo e($r->buyer->name ?? 'Buyer'); ?></div>
                                    <div class="text-sm font-bold"><?php echo e($r->rating); ?>★</div>
                                </div>

                                <?php if($r->comment): ?>
                                    <div class="mt-2 text-zinc-700"><?php echo e($r->comment); ?></div>
                                <?php endif; ?>

                                <div class="mt-2 text-xs text-zinc-500"><?php echo e($r->created_at->format('d M Y')); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Profil Seller'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/seller_profile.blade.php ENDPATH**/ ?>