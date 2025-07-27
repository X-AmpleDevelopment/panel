@extends('layouts.admin')

@section('title')
Administration Dashboard
@endsection

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-100">Welcome Back, {{ Auth::user()->name }}</h1>
            <p class="mt-2 text-gray-400">Here's what's happening with x-ample today.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="https://x-ampledevelopment.co.uk" target="_blank"
                class="px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors flex items-center space-x-2">
                <i class="fas fa-book"></i>
                <span>XD | Website</span>
            </a>
            <a href="https://discord.gg/bGhguE93Xp" target="_blank"
                class="px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors flex items-center space-x-2">
                <i class="fab fa-discord"></i>
                <span>XD | Discord</span>
            </a>
            <a href="https://github.com/XAmple-Development" target="_blank"
                class="px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors flex items-center space-x-2">
                <i class="fab fa-github"></i>
                <span>XD | Github</span>
            </a>
	    <a href="https://support.x-ampledevelopment.co.uk" target="_blank"
                class="px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors flex items-center space-x-2">
                <i class="fas fa-book"></i>
                <span>XD | Support Bot</span>
            </a>
	    <a href="https://status.x-ampledevelopment.co.uk" target="_blank"
                class="px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors flex items-center space-x-2">
                <i class="fas fa-book"></i>
                <span>XD | Live Status</span>
            </a>


            
        </div>
    </div>

    <!-- System Status -->
    <div class="glass-card rounded-xl p-6 border border-gray-700/50">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold gradient-text">System Status</h2>
            <span
                class="px-3 py-1 rounded-full {{ $version->isLatestPanel() ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                v{{ config('app.version') }}
            </span>
        </div>

        @if ($version->isLatestPanel())
            <div class="flex items-center space-x-4 bg-accent-blue/5 rounded-lg p-4">
                <div class="w-12 h-12 rounded-full bg-accent-blue/10 flex items-center justify-center">
                    <i class="fas fa-check-circle text-accent-blue text-xl"></i>
                </div>
                <div>
                    <h3 class="text-gray-200 font-medium">System Up to Date</h3>
                    <p class="text-gray-400 text-sm mt-1">You are running the latest version of X-Ample's Panel.</p>
                </div>
            </div>
        @else
            <div class="flex items-center space-x-4 bg-red-500/5 rounded-lg p-4">
                <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-red-400 font-medium">Crucial Update Available</h3>
                    <p class="text-gray-400 text-sm mt-1">
                        Version <a href="https://github.com/X-AmpleDevelopment/panel/releases/tag/v{{ $version->getPanel() }}"
                            class="text-red-400 hover:text-red-300 underline">{{ $version->getPanel() }}</a>
                        is now available.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $stats = [
                [
                    'title' => 'Total Servers',
                    'value' => $stats['servers'] ?? 0,
                    'icon' => 'fa-server',
                    'color' => 'purple',
                ],
                [
                    'title' => 'Total Users',
                    'value' => $stats['users'] ?? 0,
                    'icon' => 'fa-users',
                    'color' => 'blue',
                ],
                [
                    'title' => 'Active Nodes',
                    'value' => $stats['nodes'] ?? 0,
                    'icon' => 'fa-network-wired',
                    'color' => 'green',
                ],
                [
                    'title' => 'Server Eggs',
                    'value' => $stats['eggs'] ?? 0,
                    'icon' => 'fa-project-diagram',
                    'color' => 'yellow',
                ]
            ];
        @endphp

        @foreach ($stats as $stat)
            <div
                class="glass-card rounded-xl p-6 border border-gray-700/50 transition-all duration-300 hover:shadow-lg hover:shadow-accent-{{ $stat['color'] }}/10">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-400">{{ $stat['title'] }}</p>
                        <h4 class="text-2xl font-bold mt-1 text-accent-{{ $stat['color'] }}">
                            {{ number_format($stat['value']) }}
                        </h4>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-accent-{{ $stat['color'] }}/10 flex items-center justify-center">
                        <i class="fas {{ $stat['icon'] }} text-accent-{{ $stat['color'] }}"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Activity and Updates Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="glass-card rounded-xl p-6 border border-gray-700/50">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold gradient-text">Recent Activity</h3>
                <button class="text-gray-400 hover:text-accent-purple transition-colors">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </div>
            <div class="space-y-4">
                @foreach ($activities as $activity)
                    <div
                        class="flex items-start space-x-4 p-3 rounded-lg transition-all duration-300 hover:bg-accent-purple/5">
                        <div class="w-2 h-2 mt-2 rounded-full bg-accent-blue flex-shrink-0"></div>
                        <div class="flex-grow">
                            <p class="text-sm">
                                <span class="font-medium text-accent-blue">{{ $activity->actor->username }}</span>
                                {{ $activity->description }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-gray-500 text-sm">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- System Updates -->
<div class="glass-card rounded-xl p-6 border border-gray-700/50">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold gradient-text">System Updates</h3>
        <span class="px-3 py-1 bg-accent-purple/10 text-accent-purple rounded-full text-sm">
            {{ count($news) }} new {{ Str::plural('update', count($news)) }}
        </span>
    </div>

    <div class="space-y-4">
        @forelse ($news as $item)
            <div class="p-4 rounded-lg border border-gray-700/50 transition-all duration-300 hover:bg-accent-purple/5">
                <div class="flex items-center justify-between">
                    <h4 class="font-medium text-accent-purple">{{ $item['title'] }}</h4>
                    <span class="text-xs text-gray-400 whitespace-nowrap">{{ $item['date'] }}</span>
                </div>
                <p class="text-sm text-gray-300 mt-2">{{ $item['description'] }}</p>
                <div class="flex items-center space-x-4 mt-3">
                    <a href="{{ $item['learn_more_url'] ?? '#' }}" class="text-xs text-accent-blue hover:text-accent-purple transition-colors">
                        Learn more
                    </a>
                    <span class="text-gray-600">�</span>
                    <a href="{{ $item['changelog_url'] ?? '#' }}" class="text-xs text-accent-blue hover:text-accent-purple transition-colors">
                        View changelog
                    </a>
                </div>
            </div>
        @empty
            <div class="text-sm text-gray-400">No system updates available at this time.</div>
        @endforelse
    </div>
</div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @php
            $actions = [
                ['title' => 'Create Server', 'icon' => 'fa-plus-circle', 'color' => 'purple', 'route' => '/admin/servers/new'],
                ['title' => 'Manage Users', 'icon' => 'fa-users-cog', 'color' => 'blue', 'route' => '/admin/users'],
                ['title' => 'Manage Nodes', 'icon' => 'fa-server', 'color' => 'green', 'route' => '/admin/nodes'],
                ['title' => 'Manage Eggs', 'icon' => 'fa-project-diagram', 'color' => 'yellow', 'route' => '/admin/nests'],
            ];
        @endphp

        @foreach ($actions as $action)
            <a href="{{ $action['route'] }}"
                class="glass-card rounded-xl p-4 border border-gray-700/50 transition-all duration-300 hover:shadow-lg hover:shadow-accent-{{ $action['color'] }}/10 group">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-accent-{{ $action['color'] }}/10 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                        <i class="fas {{ $action['icon'] }} text-accent-{{ $action['color'] }}"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-200">{{ $action['title'] }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>

<style>
    .glass-card {
        @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
    }

    .gradient-text {
        @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
    }
</style>
@endsection
