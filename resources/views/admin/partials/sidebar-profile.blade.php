<div class="p-4 glass-card m-4 rounded-lg">
    <div class="flex items-center space-x-3">
        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=32"
            class="w-10 h-10 rounded-lg" alt="User Image">
        <div class="flex-1">
            <h3 class="font-medium">{{ Auth::user()->username }}</h3>
            <p class="text-sm text-gray-400">Administrator</p>
        </div>
        <div class="relative group">
            <button class="p-2 hover:bg-white/5 rounded-lg transition-colors">
                <i class="fas fa-ellipsis-v text-gray-400"></i>
            </button>
            <div
                class="absolute bottom-full right-0 mb-2 w-48 py-2 glass-card rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="{{ route('account') }}" class="flex items-center px-4 py-2 hover:bg-white/5">
                    <i class="fas fa-user-circle w-5 text-gray-400"></i>
                    <span>Account</span>
                </a>
                <a href="{{ url('/') }}" class="flex items-center px-4 py-2 hover:bg-white/5">
                    <i class="fas fa-home w-5 text-gray-400"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('auth.logout') }}" id="logoutButton"
                    class="flex items-center px-4 py-2 hover:bg-white/5 text-red-400">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>
