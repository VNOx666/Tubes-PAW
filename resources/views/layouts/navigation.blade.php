{{-- PROFILE / LOGIN --}}
@auth
    <div class="relative">
        {{-- AVATAR (TOGGLE) --}}
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

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 text-sm hover:bg-zinc-50">
                Dashboard
            </a>

            @if(auth()->user()->role === 'seller')
                <a href="{{ route('seller.profile', auth()->id()) }}"
                   class="block px-4 py-2 text-sm hover:bg-zinc-50">
                    Profil Publik
                </a>
            @endif

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-sm hover:bg-zinc-50">
                Profile
            </a>

            <div class="border-t"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-zinc-50">
                    Logout
                </button>
            </form>
        </div>
    </div>
@else
    <a href="{{ route('login') }}"
       class="px-4 py-2 rounded-xl border border-zinc-200 bg-white
              text-sm hover:bg-zinc-50">
        Login
    </a>
@endauth
