<nav class="bg-white border-b border-zinc-200">
    <div class="container py-3">
        <div class="flex items-center justify-between gap-3">

            {{-- LEFT: SELLER LOGO --}}
            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 text-decoration-none">
                <div class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center font-black">
                    T
                </div>
                <div class="font-black text-xl text-zinc-900">Seller</div>
            </a>

            {{-- RIGHT: AVATAR DROPDOWN --}}
            <div class="relative">
                {{-- AVATAR TOGGLE --}}
                <button type="button"
                        data-dropdown-toggle="userDropdown"
                        onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                        class="h-10 w-10 flex items-center justify-center rounded-full
                               border border-zinc-200 bg-white font-semibold shadow-sm
                               hover:bg-zinc-50">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </button>

                {{-- DROPDOWN --}}
                <div id="userDropdown"
                     class="hidden absolute right-0 mt-2 w-48
                            rounded-2xl border border-zinc-200 bg-white
                            shadow-lg overflow-hidden z-50">

                    {{-- DASHBOARD --}}
                    <a href="{{ route('dashboard') }}"
                       class="block px-4 py-2 text-sm hover:bg-zinc-50">
                        Dashboard
                    </a>

                    {{-- PROFIL PUBLIK --}}
                    <a href="{{ route('seller.profile', auth()->id()) }}"
                       class="block px-4 py-2 text-sm hover:bg-zinc-50">
                        Profil Publik
                    </a>

                    {{-- PROFILE --}}
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 text-sm hover:bg-zinc-50">
                        Profile
                    </a>

                    <div class="border-t"></div>

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-zinc-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>
