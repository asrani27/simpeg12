<!-- Sidebar -->
<div id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-56 bg-white/10 backdrop-blur-lg shadow-lg border-r border-white/20 transform -translate-x-full lg:relative lg:translate-x-0 transition-all duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Logo/Brand -->
        <div class="flex items-center justify-center h-12 px-3 bg-purple-600/80 backdrop-blur-sm">
            <img src="/logo/bjm.png" alt="Logo" class="h-8 mr-2">
            <h1 class="text-white text-lg font-semibold">simpeg</h1>
        </div>

        <!-- Navigation Menu - Conditional based on user role -->
        @if(Auth::user()->hasRole('superadmin'))
            @include('layouts.menu_superadmin')
        @elseif(Auth::user()->hasRole('dms'))
            @include('layouts.menu_dms')
        @elseif(Auth::user()->hasRole('pegawai'))
            @include('layouts.menu_pegawai')
        @endif

        <!-- Profile Menu -->
        <div class="px-3 py-3 border-t border-white/20">
            <div class="relative">
                <button onclick="toggleProfileMenu()"
                    class="flex items-center w-full px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white rounded-md transition-all duration-300 border border-transparent hover:border-white/20">
                    <img src="https://ui-avatars.com/api/?name=User&background=8b5cf6&color=fff" alt="Profile"
                        class="w-6 h-6 rounded-full mr-3">
                    <div class="flex-1 text-left">
                        <p class="text-xs font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/60">Administrator</p>
                    </div>
                    <svg class="w-3 h-3 transform transition-transform text-white/60" id="profileMenuIcon" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="profileMenu"
                    class="absolute bottom-full left-0 right-0 mb-2 bg-white/20 backdrop-blur-lg rounded-md shadow-lg border border-white/30 hidden">
                    <a href="/"
                        class="flex items-center px-3 py-2 text-white hover:bg-white/10 rounded-t-md transition-colors">
                        <svg class="w-3 h-3 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1 1 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-xs">Settings</span>
                    </a>
                    <form action="/logout" method="GET" class="block"
                        onsubmit="return confirm('Are you sure you want to logout?');">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-3 py-2 text-white hover:bg-white/10 rounded-b-md transition-colors">
                            <svg class="w-3 h-3 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="text-xs">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
