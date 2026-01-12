<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? config('app.name', 'Thrifty')); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-light">
    <?php if(request()->is('seller*')): ?>
    <?php echo $__env->make('layouts.seller-navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>


    <?php if (! empty(trim($__env->yieldContent('header')))): ?>
        <header class="bg-white border-bottom">
            <div class="container py-3">
                <?php echo $__env->yieldContent('header'); ?>
            </div>
        </header>
    <?php endif; ?>

    <main class="py-4">
        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/layouts/app.blade.php ENDPATH**/ ?>