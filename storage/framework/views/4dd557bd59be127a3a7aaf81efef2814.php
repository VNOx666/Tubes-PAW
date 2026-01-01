<nav class="bg-white border-b border-zinc-200">
    <div class="container py-3">
        <div class="flex items-center justify-between gap-3">

            
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                    T
                </div>
                <div class="font-black text-xl text-zinc-900">Thrifty</div>
            </a>

            
            <div class="flex items-center gap-3">

                
                <form action="<?php echo e(route('shop')); ?>" method="GET" class="relative hidden sm:block">
                    <input
                        type="text"
                        name="q"
                        value="<?php echo e(request('q')); ?>"
                        placeholder="Search..."
                        class="w-[260px] rounded-xl border border-zinc-200 bg-white
                               pl-10 pr-14 py-2 text-sm shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-zinc-200"
                    >

                    
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400">
                        🔍
                    </span>

                    
                    <span
                        class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2
                               rounded-md border border-zinc-200 bg-zinc-50
                               px-2 py-0.5 text-[10px] text-zinc-500">
                        Ctrl K
                    </span>
                </form>

                
                <?php if(auth()->guard()->check()): ?>
                    
                    <?php if(auth()->user()->role === 'seller'): ?>
                        <a href="<?php echo e(route('seller.profile', auth()->user()->id)); ?>"
                           class="h-10 w-10 flex items-center justify-center rounded-full
                                  border border-zinc-200 bg-white font-semibold shadow-sm
                                  hover:bg-zinc-50">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </a>
                    <?php else: ?>
                        
                        <a href="<?php echo e(route('profile.edit')); ?>"
                           class="h-10 w-10 flex items-center justify-center rounded-full
                                  border border-zinc-200 bg-white font-semibold shadow-sm
                                  hover:bg-zinc-50">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    
                    <a href="<?php echo e(route('login')); ?>"
                       class="px-4 py-2 rounded-xl border border-zinc-200 bg-white
                              text-sm hover:bg-zinc-50">
                        Login
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\Tubes-PAW-1\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>