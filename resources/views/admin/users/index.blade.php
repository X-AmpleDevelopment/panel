@extends('layouts.admin')

@section('title')
    List Users
@endsection



@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-users text-accent-purple"></i>
        </div>
        <div>
            User Management
            <small class="block mt-1 text-base font-normal text-gray-400">View and manage all registered users on our platform.</small>
        </div>
    </div>
</h1>
<br>
    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @php
                $quickStats = [
                    ['title' => 'Total Users', 'value' => $users->total(), 'icon' => 'fa-users', 'color' => 'blue'],
                    ['title' => 'Admins', 'value' => $users->where('root_admin', true)->count(), 'icon' => 'fa-user-shield', 'color' => 'yellow'],
                    ['title' => '2FA Enabled', 'value' => $users->where('use_totp', true)->count(), 'icon' => 'fa-shield-alt', 'color' => 'green'],
                    ['title' => 'Active Today', 'value' => $users->where('updated_at', '>=', now()->subDay())->count(), 'icon' => 'fa-clock', 'color' => 'purple'],
                ];
            @endphp

            @foreach($quickStats as $stat)
                <div class="glass-card rounded-lg p-4 transition-all duration-300 hover:shadow-lg hover:shadow-accent-{{ $stat['color'] }}/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400">{{ $stat['title'] }}</p>
                            <h4 class="text-2xl font-bold mt-1 text-accent-{{ $stat['color'] }}">{{ number_format($stat['value']) }}</h4>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-accent-{{ $stat['color'] }}/10 flex items-center justify-center">
                            <i class="fas {{ $stat['icon'] }} text-accent-{{ $stat['color'] }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Search and Actions -->
        <div class="flex items-center justify-between mb-6">
            <div class="relative flex-grow max-w-4xl">
                <form action="{{ route('admin.users') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text"
                               name="filter[email]"
                               value="{{ request()->input('filter.email') }}"
                               class="w-full bg-background-darker/80 text-white rounded-xl py-3 pl-11 pr-4 border border-gray-700/50 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple focus:ring-opacity-50"
                               placeholder="Search by name, email, or username...">
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-3 ml-4">
                <a href="{{ route('admin.users.new') }}"
                   class="px-6 py-3 bg-accent-purple text-white rounded-xl hover:bg-accent-purple/80 transition-colors flex items-center space-x-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Create User</span>
                </a>
            </div>
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($users as $user)
                <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10 border border-gray-700/50">
                    <div class="relative p-6">
                        <!-- Admin Badge -->
                        @if($user->root_admin)
                            <div class="absolute top-4 right-4 px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded-lg flex items-center">
                                <i class="fas fa-crown text-xs mr-1"></i>
                                <span class="text-xs font-medium">Admin</span>
                            </div>
                        @endif

                        <!-- User Info -->
                        <div class="flex items-start space-x-4">
                            <div class="relative group">
                                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->email)) }}?s=200"
                                     class="h-16 w-16 rounded-lg ring-2 ring-gray-700 object-cover transition-transform duration-300 group-hover:scale-105"
                                     alt="{{ $user->name_first }} {{ $user->name_last }}">
                                <div class="absolute -bottom-1 -right-1">
                                    @if($user->use_totp)
                                        <div class="bg-green-500/10 text-green-500 rounded-full p-1">
                                            <i class="fas fa-shield-alt text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex-grow min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="truncate">
                                        <h3 class="text-lg font-medium text-gray-200 truncate">
                                            {{ $user->name_first }} {{ $user->name_last }}
                                        </h3>
                                        <p class="text-sm text-gray-400 truncate">{{ $user->username }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center space-x-3 text-sm text-gray-400">
                                    <a href="mailto:{{ $user->email }}"
                                       class="flex items-center hover:text-accent-purple transition-colors truncate">
                                        <i class="fas fa-envelope mr-2"></i>
                                        <span class="truncate">{{ $user->email }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Stats & Actions -->
                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="text-center px-3 py-2 rounded-lg bg-background/50">
                                    <div class="text-sm font-medium text-gray-200">{{ $user->servers_count }}</div>
                                    <div class="text-xs text-gray-400">Servers</div>
                                </div>
                                <div class="text-center px-3 py-2 rounded-lg bg-background/50">
                                    <div class="text-sm font-medium text-gray-200">{{ $user->subuser_of_count }}</div>
                                    <div class="text-xs text-gray-400">Access</div>
                                </div>
                            </div>

                            <a href="{{ route('admin.users.view', $user->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors group">
                                <span class="text-sm font-medium mr-2">Manage</span>
                                <i class="fas fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-6">
                <div class="flex justify-center">
                    {!! $users->appends(['query' => Request::input('query')])->render() !!}
                </div>
            </div>
        @endif
    </div>
@endsection

<style>
    .glass-card {
        @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
    }

    /* Gradient text effect */
    .gradient-text {
        @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
    }
</style>
