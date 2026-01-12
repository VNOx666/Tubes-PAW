<?php $__env->startSection('content'); ?>
<div class="py-5">
    <div class="mx-auto" style="max-width: 420px;">

        <div class="bg-white border rounded-4 shadow-sm overflow-hidden">
            <div class="p-4 border-bottom">
                <div class="fs-5 fw-bold mb-1">Login</div>
                <div class="text-muted small">
                    Masuk untuk lanjut belanja / jualan.
                </div>
            </div>

            <div class="p-4">

                
                <?php if(session('status')): ?>
                    <div class="mb-3 rounded-4 border border-success-subtle bg-success-subtle px-3 py-2 small text-success-emphasis">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                
                <?php if($errors->any()): ?>
                    <div class="mb-3 rounded-4 border border-danger-subtle bg-danger-subtle px-3 py-2 small text-danger-emphasis">
                        <ul class="mb-0 ps-4">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="d-grid gap-3">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="form-label fw-semibold small mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                               class="form-control rounded-3 py-2 small">
                    </div>

                    <div>
                        <label class="form-label fw-semibold small mb-1">Password</label>
                        <input type="password" name="password" required
                               class="form-control rounded-3 py-2 small">
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <label class="d-flex align-items-center gap-2 small text-muted">
                            <input type="checkbox" name="remember" class="form-check-input mt-0">
                            Remember me
                        </label>

                        <?php if(Route::has('password.request')): ?>
                            <a class="small text-decoration-none" href="<?php echo e(route('password.request')); ?>">
                                Forgot?
                            </a>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-dark rounded-3 py-2 small fw-semibold">
                        LOG IN
                    </button>

                    <div class="text-center small text-muted">
                        Belum punya akun?
                        <a href="<?php echo e(route('register')); ?>" class="text-decoration-none fw-semibold">
                            Register
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/auth/login.blade.php ENDPATH**/ ?>