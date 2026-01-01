<nav class="bg-white border-b border-zinc-200">
    <div class="container py-3">
        <div class="flex items-center justify-between gap-3">

            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 text-decoration-none">
                <div class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                    T
                </div>
                <div class="font-black text-xl text-zinc-900">Seller</div>
            </a>

            <div class="flex items-center gap-2">
                <a href="{{ route('seller.dashboard') }}" class="px-4 py-2 rounded-2xl border border-zinc-200 bg-white hover:bg-zinc-50">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-2xl bg-zinc-900 text-white hover:opacity-90">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
