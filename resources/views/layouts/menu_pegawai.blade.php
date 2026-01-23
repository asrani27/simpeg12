<!-- Navigation Menu for Pegawai -->
<nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-500/50 scrollbar-track-transparent">
    <!-- Dashboard -->
    <a href="/pegawai/dashboard"
        class="flex items-center px-3 py-2 {{ request()->is('pegawai/dashboard') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pegawai/dashboard') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        <span class="text-sm">Dashboard</span>
    </a>

    <!-- DMS -->
    <a href="/pegawai/dms"
        class="flex items-center px-3 py-2 {{ request()->is('pegawai/dms*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pegawai/dms*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
            </path>
        </svg>
        <span class="text-sm">DMS</span>
    </a>
</nav>
