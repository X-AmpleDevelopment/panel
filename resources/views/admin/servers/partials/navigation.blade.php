@php
    /** @var \Pterodactyl\Models\Server $server */
    $router = app('router');
@endphp
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                        <div>
                            {{ $server->name }}
                            <small class="block mt-1 text-base font-normal text-gray-400">Configure server settings and resources</small>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.servers') }}"
                   class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Back to Servers
                </a>
            </div>
        </div>
        <br>

<div class="glass-card rounded-lg mb-6">
    <div class="flex items-center space-x-2 overflow-x-auto p-2">
        <a href="{{ route('admin.servers.view', $server->id) }}"
           class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
            <i class="fas fa-info-circle mr-2"></i>About
        </a>

        @if($server->isInstalled())
            <a href="{{ route('admin.servers.view.details', $server->id) }}"
               class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.details') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
                <i class="fas fa-list-alt mr-2"></i>Details
            </a>

            <a href="{{ route('admin.servers.view.build', $server->id) }}"
               class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.build') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
                <i class="fas fa-wrench mr-2"></i>Build Config
            </a>

            <a href="{{ route('admin.servers.view.startup', $server->id) }}"
               class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.startup') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
                <i class="fas fa-play mr-2"></i>Startup
            </a>

            <a href="{{ route('admin.servers.view.database', $server->id) }}"
               class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.database') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
                <i class="fas fa-database mr-2"></i>Database
            </a>

            <a href="{{ route('admin.servers.view.mounts', $server->id) }}"
               class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.mounts') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
                <i class="fas fa-hard-drive mr-2"></i>Mounts
            </a>
        @endif

        <a href="{{ route('admin.servers.view.manage', $server->id) }}"
           class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.manage') ? 'bg-accent-purple text-white' : 'text-gray-200 hover:bg-accent-purple/10' }}">
            <i class="fas fa-cog mr-2"></i>Manage
        </a>

        <div class="flex-1"></div>

        <a href="{{ route('admin.servers.view.delete', $server->id) }}"
           class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $router->currentRouteNamed('admin.servers.view.delete') ? 'bg-red-500 text-white' : 'text-red-400 hover:bg-red-500/10' }}">
            <i class="fas fa-trash mr-2"></i>Delete
        </a>

        <a href="/server/{{ $server->uuidShort }}"
           target="_blank"
           class="px-4 py-2 rounded-lg whitespace-nowrap transition-colors duration-150 text-accent-blue hover:bg-accent-blue/10">
            <i class="fas fa-external-link-alt"></i>
        </a>
    </div>
</div>
