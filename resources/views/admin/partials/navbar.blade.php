<nav
    class="glass-card h-16 px-4 lg:px-8 flex items-center justify-between backdrop-blur-sm bg-background/60 border-b border-gray-700/50">
    <div class="flex items-center flex-1">
        <button id="sidebarToggle"
            class="text-gray-400 hover:text-accent-purple transition-colors duration-200 mr-4 lg:hidden">
            <i class="fas fa-bars text-lg"></i>
        </button>
        <div class="max-w-2xl w-full">
            <button id="searchTrigger"
                class="w-full flex items-center space-x-3 text-gray-300 hover:text-accent-purple transition-colors duration-200 bg-background/40 hover:bg-background/60 rounded-lg px-4 py-2 group backdrop-blur-sm">
                <i class="fas fa-search group-hover:text-accent-purple transition-colors duration-200"></i>
                <span class="hidden sm:inline text-sm font-medium flex-1 text-left">Search... <span
                        class="text-gray-500 text-xs">(Ctrl + K)</span></span>
            </button>
        </div>

        <!-- Quick Navigation -->
        <div class="hidden md:flex items-center ml-6 space-x-3">
            <a href="{{ route('admin.index') }}"
                class="text-gray-400 hover:text-accent-purple transition-colors duration-200">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('admin.nodes') }}"
                class="text-gray-400 hover:text-accent-purple transition-colors duration-200">
                <i class="fas fa-server"></i>
            </a>
            <a href="{{ route('admin.mounts') }}"
                class="text-gray-400 hover:text-accent-purple transition-colors duration-200">
                <i class="fas fa-hdd"></i>
            </a>
        </div>
    </div>

    <div class="flex items-center space-x-3">
        <!-- System Status Indicator -->
        <div class="hidden lg:flex items-center space-x-2 px-3 py-1.5 bg-background/40 rounded-lg backdrop-blur-sm">
            <div class="w-2 h-2 rounded-full bg-green-500"></div>
            <span class="text-xs text-gray-400">System Functional</span>
        </div>

        <!-- Quick Actions -->
        <a href="{{ route('admin.servers.new') }}"
            class="px-4 py-2 rounded-lg flex items-center space-x-2 bg-accent-purple/90 hover:bg-accent-purple transition-colors duration-200 group backdrop-blur-sm">
            <i class="fas fa-plus text-white/80 group-hover:text-white transition-colors duration-200"></i>
            <span class="text-white text-sm font-medium">New Server</span>
        </a>
        <a href="{{ route('admin.users.new') }}"
            class="px-4 py-2 rounded-lg flex items-center space-x-2 bg-background/40 hover:bg-background/60 transition-colors duration-200 group border border-gray-700/50 backdrop-blur-sm">
            <i class="fas fa-user-plus text-gray-400 group-hover:text-accent-purple transition-colors duration-200"></i>
            <span class="text-white text-sm font-medium">New User</span>
        </a>

        <!-- User Profile -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-3 p-1.5 text-gray-300 hover:text-accent-purple transition-colors duration-200 bg-background/40 hover:bg-background/60 rounded-lg backdrop-blur-sm">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160"
                    class="w-6 h-6 rounded-full" alt="Profile">
                <span class="text-sm font-medium hidden lg:block">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>

            <!-- Profile Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 rounded-lg bg-background/95 backdrop-blur-sm border border-gray-700/50 shadow-lg z-50">
                <div class="p-2 space-y-1">
                    <a href="{{ route('admin.users.view', Auth::user()->id) }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-200 hover:bg-accent-purple/10 hover:text-accent-purple transition-colors">
                        <i class="fas fa-user"></i>
                        <span class="text-sm">Profile</span>
                    </a>
                    <a href="{{ route('admin.settings') }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-200 hover:bg-accent-purple/10 hover:text-accent-purple transition-colors">
                        <i class="fas fa-cog"></i>
                        <span class="text-sm">Settings</span>
                    </a>
                    <hr class="border-gray-700/50">
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-2 px-3 py-2 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchTrigger = document.getElementById('searchTrigger');
        const searchInput = document.getElementById('searchInput');

        searchTrigger.addEventListener('click', function () {
            searchInput.focus();
        });

        document.addEventListener('keydown', function (event) {
            if (event.ctrlKey && event.key === 'k') {
                event.preventDefault();
                searchTrigger.click();
            }
        });


        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                searchInput.blur();
            }
        });
    });


</script>
