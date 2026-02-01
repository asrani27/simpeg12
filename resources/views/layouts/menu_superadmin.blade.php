<!-- Navigation Menu for Superadmin -->
<nav
    class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-500/50 scrollbar-track-transparent">
    <!-- Dashboard -->
    <a href="/superadmin/dashboard"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/dashboard') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/dashboard') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        <span class="text-sm">Dashboard</span>
    </a>

    <!-- Kelola User -->
    <a href="/superadmin/user"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/user*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/user*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
            </path>
        </svg>
        <span class="text-sm">Admin Layanan</span>
    </a>

    <!-- SKPD -->
    <a href="/superadmin/skpd"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/skpd*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/skpd*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
            </path>
        </svg>
        <span class="text-sm">SKPD</span>
    </a>

    <!-- Pegawai -->
    <a href="/superadmin/pegawai"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/pegawai*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/pegawai*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
        </svg>
        <span class="text-sm">Pegawai</span>
    </a>

</nav>