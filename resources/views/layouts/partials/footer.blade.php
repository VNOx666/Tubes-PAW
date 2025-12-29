<footer class="border-t border-zinc-200 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-4 gap-8">
        <div class="space-y-2">
            <div class="font-bold text-lg">Thrifty</div>
            <p class="text-sm text-zinc-600">Marketplace thrifting: barang unik, harga santai, dan lebih ramah
                lingkungan.</p>
        </div>
        <div class="space-y-2 text-sm">
            <div class="font-semibold">Fitur</div>
            <a class="block text-zinc-600 hover:text-black" href="{{ route('shop') }}">Search & Filter</a>
            <a class="block text-zinc-600 hover:text-black" href="{{ route('chat') }}">Chat Pembeli/Penjual</a>
            <a class="block text-zinc-600 hover:text-black" href="{{ route('orders') }}">Tracking Status</a>
            <a class="block text-zinc-600 hover:text-black" href="{{ route('seller.dashboard') }}">Dashboard Penjual</a>
        </div>
        <div class="space-y-2 text-sm">
            <div class="font-semibold">Bantuan</div>
            <span class="block text-zinc-600">FAQ</span>
            <span class="block text-zinc-600">Cara Order</span>
            <span class="block text-zinc-600">Kebijakan</span>
        </div>
        <div class="space-y-2 text-sm">
            <div class="font-semibold">Kontak</div>
            <span class="block text-zinc-600">support@thrifty.test</span>
            <span class="block text-zinc-600">Jakarta • Indonesia</span>
        </div>
    </div>
    <div class="text-xs text-zinc-500 text-center py-4 border-t border-zinc-200">
        © {{ date('Y') }} Thrifty. Built with Laravel.
    </div>
</footer>
