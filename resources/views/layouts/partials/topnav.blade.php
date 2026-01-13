<header class="sticky top-0 z-30 bg-zinc-50/80 backdrop-blur">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-end gap-3">
            {{-- Search --}}
            <div class="hidden sm:block w-full max-w-md">
                <div class="flex items-center gap-2 bg-white border border-zinc-200 rounded-2xl px-4 py-2 shadow-sm">
                    <svg class="w-5 h-5 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                    <input class="w-full outline-none text-sm bg-transparent" placeholder="Search..." />
                    <span class="text-[11px] px-2 py-1 rounded-lg bg-zinc-100 text-zinc-600 border border-zinc-200">Ctrl K</span>
                </div>
            </div>

            {{-- Auth --}}
            @auth
                <a href="{{ route('profile.edit') }}"
                   class="h-10 w-10 rounded-full bg-white border border-zinc-200 flex items-center justify-center shadow-sm">
                    <span class="font-semibold text-zinc-800">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-2xl bg-white border border-zinc-200 hover:bg-zinc-50">
                    Login
                </a>
            @endauth
        </div>
    </div>
</header>
