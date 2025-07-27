@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}
@endsection

@section('content-header')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-semibold gradient-text">{{ $server->name }}</h1>
            <p class="text-gray-400 mt-1">{{ str_limit($server->description) }}</p>
        </div>
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('admin.index') }}" class="text-accent-blue hover:text-accent-blue/80">Admin</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li><a href="{{ route('admin.servers') }}" class="text-accent-blue hover:text-accent-blue/80">Servers</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-gray-400">{{ $server->name }}</li>
        </ol>
    </div>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Server Status Cards -->
        <div class="lg:col-span-1 space-y-6">
            @if($server->isSuspended())
                <div class="glass-card rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-yellow-500/10">
                            <i class="fas fa-pause text-yellow-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-yellow-500">Suspended</h3>
                            <p class="text-sm text-gray-400">Server is currently suspended</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(!$server->isInstalled())
                <div class="glass-card rounded-lg p-6 border-l-4 {{ !$server->isInstalled() ? 'border-accent-blue' : 'border-red-500' }}">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg {{ !$server->isInstalled() ? 'bg-accent-blue/10' : 'bg-red-500/10' }}">
                            <i class="fas {{ !$server->isInstalled() ? 'fa-spinner fa-spin' : 'fa-times' }} text-xl {{ !$server->isInstalled() ? 'text-accent-blue' : 'text-red-500' }}"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold {{ !$server->isInstalled() ? 'text-accent-blue' : 'text-red-500' }}">
                                {{ !$server->isInstalled() ? 'Installing' : 'Install Failed' }}
                            </h3>
                            <p class="text-sm text-gray-400">
                                {{ !$server->isInstalled() ? 'Server installation in progress' : 'Server installation failed' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Owner Card -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold gradient-text">Server Owner</h3>
                        <div class="p-2 rounded-lg bg-accent-purple/10">
                            <i class="fas fa-user text-accent-purple"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($server->user->email)) }}?s=100&d=mp"
                             class="w-12 h-12 rounded-full"
                             alt="Owner Avatar">
                        <div class="ml-4">
                            <h4 class="text-gray-200 font-medium">{{ $server->user->username }}</h4>
                            <p class="text-sm text-gray-400">{{ $server->user->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.view', $server->user->id) }}"
                       class="mt-4 flex items-center justify-center px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors">
                        <span>View Profile</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Node Card -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold gradient-text">Node Information</h3>
                        <div class="p-2 rounded-lg bg-accent-purple/10">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <span class="text-gray-400">Node:</span>
                            <span class="ml-auto text-gray-200">{{ $server->node->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-400">Location:</span>
                            <span class="ml-auto text-gray-200">{{ $server->node->location->short }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.nodes.view', $server->node->id) }}"
                       class="mt-4 flex items-center justify-center px-4 py-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors">
                        <span>View Node</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Server Information -->
        <div class="lg:col-span-2">
            <div class="glass-card rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold gradient-text">Server Information</h3>
                        <div class="p-2 rounded-lg bg-accent-purple/10">
                            <i class="fas fa-info-circle text-accent-purple"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400">Internal ID</label>
                                <div class="mt-1 px-3 py-2 bg-background-darker rounded-lg">
                                    <code class="text-accent-purple">{{ $server->id }}</code>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm text-gray-400">External ID</label>
                                <div class="mt-1 px-3 py-2 bg-background-darker rounded-lg">
                                    @if(is_null($server->external_id))
                                        <span class="text-gray-500">Not Set</span>
                                    @else
                                        <code class="text-accent-purple">{{ $server->external_id }}</code>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="text-sm text-gray-400">UUID</label>
                                <div class="mt-1 px-3 py-2 bg-background-darker rounded-lg">
                                    <code class="text-accent-purple">{{ $server->uuid }}</code>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400">Current Egg</label>
                                <div class="mt-1 flex items-center space-x-2">
                                    <a href="{{ route('admin.nests.view', $server->nest_id) }}"
                                       class="px-3 py-1 bg-accent-purple/10 rounded-lg text-accent-purple hover:bg-accent-purple/20">
                                        {{ $server->nest->name }}
                                    </a>
                                    <span class="text-gray-400">::</span>
                                    <a href="{{ route('admin.nests.egg.view', $server->egg_id) }}"
                                       class="px-3 py-1 bg-accent-purple/10 rounded-lg text-accent-purple hover:bg-accent-purple/20">
                                        {{ $server->egg->name }}
                                    </a>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm text-gray-400">Default Connection</label>
                                <div class="mt-1 px-3 py-2 bg-background-darker rounded-lg">
                                    <code class="text-accent-purple">{{ $server->allocation->ip }}:{{ $server->allocation->port }}</code>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm text-gray-400">Connection Alias</label>
                                <div class="mt-1 px-3 py-2 bg-background-darker rounded-lg">
                                    @if($server->allocation->alias !== $server->allocation->ip)
                                        <code class="text-accent-purple">{{ $server->allocation->alias }}:{{ $server->allocation->port }}</code>
                                    @else
                                        <span class="text-gray-500">No Alias Assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resource Information -->
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-200 mb-4">Resource Limits</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="glass-card rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">CPU Limit</span>
                                    <div class="px-2 py-1 rounded bg-background-darker">
                                        @if($server->cpu === 0)
                                            <span class="text-green-400">Unlimited</span>
                                        @else
                                            <span class="text-accent-purple">{{ $server->cpu }}%</span>
                                        @endif
                                    </div>
                                </div>
                                @if($server->threads)
                                    <div class="mt-2 text-sm text-gray-400">
                                        Pinned to threads: <code class="text-accent-purple">{{ $server->threads }}</code>
                                    </div>
                                @endif
                            </div>

                            <div class="glass-card rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Memory</span>
                                    <div class="px-2 py-1 rounded bg-background-darker">
                                        @if($server->memory === 0)
                                            <span class="text-green-400">Unlimited</span>
                                        @else
                                            <span class="text-accent-purple">{{ $server->memory }}MiB</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-400">
                                    Swap:
                                    @if($server->swap === 0)
                                        <span class="text-yellow-400">Disabled</span>
                                    @elseif($server->swap === -1)
                                        <span class="text-green-400">Unlimited</span>
                                    @else
                                        <span class="text-accent-purple">{{ $server->swap }}MiB</span>
                                    @endif
                                </div>
                            </div>

                            <div class="glass-card rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Disk Space</span>
                                    <div class="px-2 py-1 rounded bg-background-darker">
                                        @if($server->disk === 0)
                                            <span class="text-green-400">Unlimited</span>
                                        @else
                                            <span class="text-accent-purple">{{ $server->disk }}MiB</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-400">
                                    IO Weight: <span class="text-accent-purple">{{ $server->io }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
