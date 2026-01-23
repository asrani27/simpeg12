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

    <!-- Data Pegawai (Menu with Submenu) -->
    {{-- <div class="space-y-1">
        <button onclick="toggleSubmenu('pegawai')"
            class="flex items-center justify-between w-full px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white rounded-md transition-all duration-300 border border-transparent hover:border-white/20">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <span class="text-sm">Data Pegawai</span>
            </div>
            <svg id="pegawai-icon" class="w-3 h-3 transform transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <!-- Submenu -->
        <div id="pegawai-submenu" class="hidden pl-4 space-y-1">
            <a href="/superadmin/pegawai/list"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/pegawai/list*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Daftar Pegawai</span>
            </a>
            <a href="/superadmin/pegawai/tambah"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/pegawai/tambah*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Tambah Pegawai</span>
            </a>
            <a href="/superadmin/pegawai/aktif"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/pegawai/aktif*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Pegawai Aktif</span>
            </a>
        </div>
    </div>

    <!-- Absensi -->
    <a href="/superadmin/absensi"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/absensi*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/absensi*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
        <span class="text-sm">Absensi</span>
    </a>

    <!-- Cuti (Menu with Submenu) -->
    <div class="space-y-1">
        <button onclick="toggleSubmenu('cuti')"
            class="flex items-center justify-between w-full px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white rounded-md transition-all duration-300 border border-transparent hover:border-white/20">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="text-sm">Cuti</span>
            </div>
            <svg id="cuti-icon" class="w-3 h-3 transform transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <!-- Submenu -->
        <div id="cuti-submenu" class="hidden pl-4 space-y-1">
            <a href="/superadmin/cuti/permohonan"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/cuti/permohonan*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Permohonan Cuti</span>
            </a>
            <a href="/superadmin/cuti/history"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/cuti/history*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Riwayat Cuti</span>
            </a>
        </div>
    </div>

    <!-- Jabatan -->
    <a href="/superadmin/jabatan"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/jabatan*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/jabatan*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
        </svg>
        <span class="text-sm">Jabatan</span>
    </a>

    <!-- Gaji -->
    <a href="/superadmin/gaji"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/gaji*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/gaji*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
        <span class="text-sm">Gaji</span>
    </a>

    <!-- Laporan -->
    <a href="/superadmin/laporan"
        class="flex items-center px-3 py-2 {{ request()->is('superadmin/laporan*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('superadmin/laporan*') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
            </path>
        </svg>
        <span class="text-sm">Laporan</span>
    </a> --}}

    <!-- Pengaturan (Menu with Submenu) -->
    {{-- <div class="space-y-1">
        <button onclick="toggleSubmenu('pengaturan')"
            class="flex items-center justify-between w-full px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white rounded-md transition-all duration-300 border border-transparent hover:border-white/20">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
                <span class="text-sm">Pengaturan</span>
            </div>
            <svg id="pengaturan-icon" class="w-3 h-3 transform transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <!-- Submenu -->
        <div id="pengaturan-submenu" class="hidden pl-4 space-y-1">
            <a href="/superadmin/pengaturan/profil"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/pengaturan/profil*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Profil</span>
            </a>
            <a href="/superadmin/pengaturan/user"
                class="flex items-center px-3 py-2 {{ request()->is('superadmin/pengaturan/user*') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md' : 'text-white/70 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-200">
                <span class="text-sm">Manajemen User</span>
            </a>
        </div>
    </div> --}}
</nav>