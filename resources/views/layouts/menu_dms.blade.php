<!-- Navigation Menu for DMS -->
<nav
    class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-500/50 scrollbar-track-transparent">
    <!-- Dashboard -->
    <a href="/dms/dashboard"
        class="flex items-center px-3 py-2 {{ request()->is('dms/dashboard') ? 'text-white bg-white/20 backdrop-blur-sm rounded-md border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }} rounded-md transition-all duration-300 border {{ request()->is('dms/dashboard') ? 'border-white/30' : 'border-transparent hover:border-white/20' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        <span class="text-sm">Dashboard</span>
    </a>

</nav>