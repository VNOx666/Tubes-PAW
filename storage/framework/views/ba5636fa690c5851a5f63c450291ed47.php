<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Thrifty')); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="min-h-screen bg-zinc-50">

    
    <nav class="bg-white border-b border-zinc-200">
        <div class="container py-3">
            <div class="flex items-center justify-between gap-3">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 text-decoration-none">
                    <div class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                        T
                    </div>
                    <div class="font-black text-xl text-zinc-900">Thrifty</div>
                </a>

                <div class="flex items-center gap-2">
                    <a href="<?php echo e(route('login')); ?>"
                       class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    
    <div class="py-10">
        <div class="container">
            <div class="max-w-md mx-auto">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/layouts/guest.blade.php ENDPATH**/ ?>