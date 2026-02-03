<!-- Navigation Menu for pensiun -->
<nav
    class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-500/50 scrollbar-track-transparent">
    <!-- Beranda -->
    <a href="/pensiun/dashboard"
        class="flex items-center px-3 py-2 {{ request()->is('pensiun/dashboard') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pensiun/home') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        <span class="text-sm">Beranda</span>
    </a>

    <!-- pensiun -->
    {{-- <a href="/pensiun/pangkat"
        class="flex items-center px-3 py-2 {{ request()->is('pensiun/pangkat') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pensiun/pangkat') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
            </path>
        </svg>
        <span class="text-sm">pensiun</span>
    </a> --}}

    <!-- Layanan Kenaikan Pangkat -->
    <a href="/pensiun/jenis_pensiun"
        class="flex items-center px-3 py-2 {{ request()->is('pensiun/jenis_pensiun') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pensiun/jenis_kenaikan') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
            </path>
        </svg>
        <span class="text-sm">Layanan</span>
    </a>

    <!-- Persyaratan -->
    <a href="/pensiun/persyaratan"
        class="flex items-center px-3 py-2 {{ request()->is('pensiun/persyaratan') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('pensiun/persyaratan') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
            </path>
        </svg>
        <span class="text-sm">Persyaratan</span>
    </a>

    <!-- Periode -->
    <a href="/periode"
        class="flex items-center px-3 py-2 {{ request()->is('periode') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('periode') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
        </svg>
        <span class="text-sm">Periode</span>
    </a>

</nav>