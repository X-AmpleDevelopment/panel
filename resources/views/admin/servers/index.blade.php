@extends('layouts.admin')

@section('title')
    Servers
@endsection

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                        <div>
                            Servers
                            <small class="block mt-1 text-base font-normal text-gray-400">All servers available on our system</small>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="flex items-center space-x-3">
                <form action="{{ route('admin.servers') }}" method="GET">
                    <div class="relative">
                        <input type="text"
                               name="filter[*]"
                               value="{{ request()->input()['filter']['*'] ?? '' }}"
                               class="w-64 bg-background/50 text-white rounded-xl py-2.5 pl-11 pr-4 border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple focus:ring-opacity-50 transition-all duration-300"
                               placeholder="Search servers...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-500"></i>
                        </div>
                    </div>
                </form>
                <a href="{{ route('admin.servers.new') }}"
                   class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-all duration-300 group">
                    <i class="fas fa-plus-circle mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                    Create New
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @foreach ($servers as $server)
            <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                <div class="p-5 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-accent-purple/10 rounded-lg">
                                @if($server->isSuspended())
                                    <i class="fas fa-ban text-red-500"></i>
                                @elseif(! $server->isInstalled())
                                    <i class="fas fa-spinner fa-spin text-yellow-500"></i>
                                @else
                                    <i class="fas fa-cube text-emerald-500"></i>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.servers.view', $server->id) }}"
                                   class="text-lg font-medium text-gray-100 hover:text-accent-purple transition-colors">
                                    {{ $server->name }}
                                </a>
                                <div class="flex items-center mt-1 space-x-2 text-sm">
                                    <span class="text-gray-400">Owner:</span>
                                    <a href="{{ route('admin.users.view', $server->user->id) }}"
                                       class="text-accent-blue hover:text-accent-purple transition-colors">
                                        {{ $server->user->username }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <div class="text-sm text-gray-400">Status</div>
                                @if($server->isSuspended())
                                    <span class="text-red-500">Suspended</span>
                                @elseif(! $server->isInstalled())
                                    <span class="text-yellow-500">Installing</span>
                                @else
                                    <span class="text-emerald-500">Active</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="/server/{{ $server->uuidShort }}"
                                   class="p-2 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors">
                                    <i class="fas fa-wrench"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="bg-background/50 rounded-lg p-4">
                            <div class="text-sm text-gray-400 mb-1">Node</div>
                            <a href="{{ route('admin.nodes.view', $server->node->id) }}"
                               class="text-accent-blue hover:text-accent-purple transition-colors">
                                {{ $server->node->name }}
                            </a>
                        </div>
                        <div class="bg-background/50 rounded-lg p-4">
                            <div class="text-sm text-gray-400 mb-1">Connection</div>
                            <code class="text-accent-blue">
                                {{ $server->allocation->alias }}:{{ $server->allocation->port }}
                            </code>
                        </div>
                        <div class="bg-background/50 rounded-lg p-4">
                            <div class="text-sm text-gray-400 mb-1">UUID</div>
                            <code class="text-accent-blue" title="{{ $server->uuid }}">
                                {{ $server->uuidShort }}
                            </code>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($servers->hasPages())
        <div class="mt-6">
            {{ $servers->appends(['filter' => Request::input('filter')])->links() }}
        </div>
    @endif
@endsection

@section('footer-scripts')
    @parent
    <script>
        document.querySelectorAll('.console-popout').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                window.open(this.getAttribute('href'), 'Pterodactyl Console', 'width=800,height=400');
            });
        });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
