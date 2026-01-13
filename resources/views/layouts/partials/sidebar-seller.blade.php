@php
    $active = fn($cond) => $cond ? 'bg-black text-white' : 'text-zinc-600 hover:bg-zinc-100 hover:text-black';
@endphp

<aside class="w-[84px] shrink-0 border-end bg-white min-h-screen sticky top-0">
    <div class="h-full d-flex flex-column align-items-center py-3 gap-3">

        <div class="w-100 px-2 d-flex flex-column align-items-center gap-2 mt-2">

            {{-- Dashboard --}}
            <a href="{{ route('seller.dashboard') }}"
               class="d-flex align-items-center justify-content-center rounded-3xl {{ $active(request()->routeIs('seller.dashboard')) }}"
               style="width:56px;height:56px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M4 13h7V4H4v9zM13 20h7V11h-7v9zM13 4h7v5h-7V4zM4 16h7v4H4v-4z"
                          stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </a>

            {{-- Products --}}
            <a href="{{ route('seller.products.index') }}"
               class="d-flex align-items-center justify-content-center rounded-3xl {{ $active(request()->routeIs('seller.products.*')) }}"
               style="width:56px;height:56px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 8l-9 5-9-5 9-5 9 5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M3 8v10l9 5 9-5V8" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </a>

            {{-- Orders --}}
            <a href="{{ route('seller.orders.index') }}"
               class="d-flex align-items-center justify-content-center rounded-3xl {{ $active(request()->routeIs('seller.orders.*')) }}"
               style="width:56px;height:56px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7 7h10M7 12h10M7 17h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 3h14v18l-3-2-4 2-4-2-3 2V3z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </a>

            {{-- Chat --}}
            <a href="{{ route('seller.chat') }}"
               class="d-flex align-items-center justify-content-center rounded-3xl {{ $active(request()->routeIs('seller.chat') || request()->routeIs('seller.chat.*')) }}"
               style="width:56px;height:56px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12c0 4.4-4 8-9 8-1.1 0-2.2-.2-3.2-.6L3 21l1.6-4.1A7.5 7.5 0 0 1 3 12c0-4.4 4-8 9-8s9 3.6 9 8z"
                          stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="mt-auto w-100 px-2 d-flex flex-column align-items-center gap-2 pb-2">
            <a href="{{ route('profile.edit') }}"
               class="d-flex align-items-center justify-content-center rounded-3xl {{ $active(request()->routeIs('profile.edit')) }}"
               style="width:56px;height:56px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"
                          stroke="currentColor" stroke-width="2"/>
                    <path d="M19.4 15a7.9 7.9 0 0 0 .1-6l2-1.2-2-3.5-2.3.7a8.1 8.1 0 0 0-5.2-3L12 0H8l-.9 2.1a8.1 8.1 0 0 0-5.2 3L-.4 4.4l-2 3.5 2 1.2a7.9 7.9 0 0 0 .1 6l-2 1.2 2 3.5 2.3-.7a8.1 8.1 0 0 0 5.2 3L8 24h4l.9-2.1a8.1 8.1 0 0 0 5.2-3l2.3.7 2-3.5-2-1.2z"
                          stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="w-100 d-flex justify-content-center">
                @csrf
                <button type="submit"
                        class="d-flex align-items-center justify-content-center rounded-3xl text-zinc-600 hover:bg-zinc-100 hover:text-black"
                        style="width:56px;height:56px;border:0;background:transparent;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M10 17l-1 0a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4h1"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M13 9l3 3-3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</aside>    
