<?php $__env->startSection('content'); ?>
    <div class="flex items-start justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black">Dashboard Penjual</h1>
            <p class="text-zinc-600">Kelola barang, order, status, dan chat.</p>
        </div>

        <a href="<?php echo e(route('seller.products.create')); ?>"
           class="px-4 py-2 rounded-2xl bg-black text-white hover:opacity-90">
            + Tambah Barang
        </a>
    </div>

    <div class="mt-5 grid md:grid-cols-4 gap-4">
        <?php $__currentLoopData = [['t' => 'Barang Aktif', 'v' => '24'], ['t' => 'Order Baru', 'v' => '3'], ['t' => 'Dalam Pengiriman', 'v' => '5'], ['t' => 'Rating', 'v' => '4.9★']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
                <div class="text-xs text-zinc-500"><?php echo e($c['t']); ?></div>
                <div class="text-2xl font-black mt-1"><?php echo e($c['v']); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-6 grid lg:grid-cols-2 gap-6">
        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Order Terbaru</div>
            <div class="mt-3 space-y-2 text-sm">
                <?php $__currentLoopData = [['#201', 'Dikemas'], ['#202', 'Menunggu Resi'], ['#203', 'Dikirim']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-zinc-50 border border-zinc-200">
                        <span class="font-semibold"><?php echo e($o[0]); ?></span>
                        <span class="text-xs px-3 py-1 rounded-full bg-black text-white"><?php echo e($o[1]); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-zinc-200 shadow-soft p-4">
            <div class="font-bold">Shortcut</div>

            <div class="mt-3 grid sm:grid-cols-2 gap-2">
                
                <a href="<?php echo e(route('seller.products.index')); ?>"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">CRUD Barang</div>
                    <div class="text-xs text-zinc-500">Tambah/edit/hapus barang</div>
                </a>

                
                <a href="<?php echo e(route('seller.chat')); ?>"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Chat Pembeli</div>
                    <div class="text-xs text-zinc-500">Balas lebih cepat</div>
                </a>

                
                <a href="<?php echo e(route('seller.orders.index')); ?>"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Tracking Status</div>
                    <div class="text-xs text-zinc-500">Update resi & status</div>
                </a>

                
                <a href="<?php echo e(route('profile.edit')); ?>"
                   class="p-4 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    <div class="font-semibold">Profil & Rating</div>
                    <div class="text-xs text-zinc-500">Lihat feedback</div>
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Dashboard Penjual — Thrifty'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/pages/seller/dashboard.blade.php ENDPATH**/ ?>