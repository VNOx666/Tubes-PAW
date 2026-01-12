<?php $__env->startSection('content'); ?>
<div class="py-4">
    <div class="mx-auto" style="max-width: 820px;">

        
        <?php if(session('status')): ?>
            <div class="mb-3 rounded-4 border border-success-subtle bg-success-subtle px-3 py-2 text-success-emphasis small">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="mb-3 rounded-4 border border-danger-subtle bg-danger-subtle px-3 py-2 text-danger-emphasis">
                <div class="fw-semibold mb-1 small">Ada error:</div>
                <ul class="mb-0 ps-4">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="small"><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="bg-white border rounded-4 shadow-sm overflow-hidden">

            
            <div class="p-4 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center fw-bold text-white"
                         style="width:48px;height:48px;border-radius:16px;background:#111;">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                    </div>

                    <div>
                        <div class="h5 mb-0 fw-bold">Profile</div>
                        <div class="text-muted small">
                            Role:
                            <span class="fw-semibold text-dark">
                                <?php echo e(auth()->user()->role === 'seller' ? 'Seller' : 'Buyer'); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4">

                
                <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="d-grid gap-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    
                    <div>
                        <label class="form-label fw-semibold small">Nama</label>
                        <input type="text" name="name"
                               value="<?php echo e(old('name', auth()->user()->name)); ?>"
                               class="form-control rounded-4">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="form-label fw-semibold small">Bio</label>
                        <textarea name="bio" rows="3"
                                  class="form-control rounded-4"
                                  placeholder="Tulis bio singkat..."><?php echo e(old('bio', auth()->user()->bio)); ?></textarea>
                        <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="form-label fw-semibold small">Gender</label>
                        <select name="gender" class="form-select rounded-4">
                            <option value="">Pilih</option>
                            <option value="male"   <?php echo e(old('gender', auth()->user()->gender) === 'male' ? 'selected' : ''); ?>>Male</option>
                            <option value="female" <?php echo e(old('gender', auth()->user()->gender) === 'female' ? 'selected' : ''); ?>>Female</option>
                            <option value="other"  <?php echo e(old('gender', auth()->user()->gender) === 'other' ? 'selected' : ''); ?>>Other</option>
                        </select>
                        <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" name="email"
                               value="<?php echo e(old('email', auth()->user()->email)); ?>"
                               class="form-control rounded-4">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="pt-1">
                        <button type="submit" class="btn btn-dark rounded-4 px-4">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                
                <div class="d-flex flex-column flex-sm-row gap-2">

                    
                    <?php
                        $targetRole = auth()->user()->role === 'seller' ? 'buyer' : 'seller';
                    ?>

                    <a
                        href="<?php echo e(route('login', ['switch' => $targetRole, 'redirect' => url('/')])); ?>"
                        class="btn btn-outline-secondary rounded-4 px-4"
                    >
                        Switch ke <?php echo e($targetRole === 'buyer' ? 'Buyer' : 'Seller'); ?>

                    </a>

                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="ms-sm-auto">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-danger rounded-4 px-4">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/profile/edit.blade.php ENDPATH**/ ?>