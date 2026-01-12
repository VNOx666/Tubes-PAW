<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-black">Detail Pesanan (Seller)</h1>
                <p class="text-zinc-600"><?php echo e($order->code); ?> • Buyer: <?php echo e($order->user->name); ?></p>
            </div>
            <a href="<?php echo e(route('seller.orders.index')); ?>"
                class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                Kembali
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                <?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="mt-6 grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 rounded-3xl bg-white border border-zinc-200 shadow-soft overflow-hidden">
                <div class="p-4 border-b border-zinc-200 flex items-center justify-between">
                    <div class="font-bold">Item Kamu</div>
                    <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                        <?php echo e(strtoupper($order->status)); ?>

                    </span>
                </div>

                <div class="divide-y divide-zinc-200">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 flex items-center justify-between gap-3">
                            <div>
                                <div class="font-semibold"><?php echo e($it->product_name); ?></div>
                                <div class="text-sm text-zinc-600">
                                    Rp <?php echo e(number_format($it->price, 0, ',', '.')); ?> × <?php echo e($it->qty); ?>

                                </div>
                            </div>
                            <div class="font-black">
                                Rp <?php echo e(number_format($it->line_total, 0, ',', '.')); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4 h-fit space-y-4">
                <div>
                    <div class="font-bold">Update Status</div>
                    <p class="text-sm text-zinc-600">Ubah progres pengiriman.</p>
                </div>

                <form method="POST" action="<?php echo e(route('seller.orders.status', $order)); ?>" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <select name="status" class="w-full rounded-2xl border border-zinc-200 bg-white px-3 py-2">
                        <?php $__currentLoopData = ['pending', 'paid', 'packed', 'shipped', 'delivered', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s); ?>" <?php if($order->status === $s): echo 'selected'; endif; ?>>
                                <?php echo e(strtoupper($s)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <button class="w-full px-4 py-3 rounded-2xl bg-black text-white hover:opacity-90">
                        Simpan Status
                    </button>
                </form>

                <div class="border-t border-zinc-200 pt-3 text-sm">
                    <div class="font-semibold">Alamat Buyer</div>
                    <div class="text-zinc-600 mt-1 whitespace-pre-line"><?php echo e($order->address); ?></div>
                    <div class="text-zinc-600 mt-1"><?php echo e($order->receiver_name); ?> • <?php echo e($order->phone); ?></div>
                </div>

                <a href="<?php echo e(route('seller.chat')); ?>"
                    class="block w-full text-center px-4 py-3 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Buka Chat
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/seller/orders/show.blade.php ENDPATH**/ ?>