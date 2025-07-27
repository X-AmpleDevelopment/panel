@extends('layouts.admin')

@section('title')
    {{ $node->name }}
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
                            {{ $node->name }}
                            <small class="block mt-1 text-base font-normal text-gray-400">Node Overview & Management</small>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.nodes') }}"
                   class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Back to Nodes
                </a>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex items-center space-x-2 mt-8 border-b border-gray-700">
            <a href="{{ route('admin.nodes.view', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium rounded-t-lg bg-accent-purple text-white border-b-2 border-accent-purple">
                Overview
            </a>
            <a href="{{ route('admin.nodes.view.settings', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Settings
            </a>
            <a href="{{ route('admin.nodes.view.configuration', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Configuration
            </a>
            <a href="{{ route('admin.nodes.view.allocation', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Allocation
            </a>
            <a href="{{ route('admin.nodes.view.servers', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Servers
            </a>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="col-span-2 space-y-8">
            <!-- System Information -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-5 border-b border-gray-700">
                    <h3 class="text-xl font-semibold gradient-text">System Information</h3>
                </div>
                <div class="p-5 space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-background/50 rounded-lg p-4 flex items-center space-x-4">
                            <div class="p-3 bg-accent-purple/10 rounded-lg">
                                <i class="fas fa-code-branch text-accent-purple text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-400">Daemon Version</div>
                                <div class="text-lg font-semibold text-gray-100 flex items-center space-x-2">
                                    <code data-attr="info-version" class="bg-background px-2 py-0.5 rounded text-accent-blue">
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </code>
                                    <span class="text-sm text-gray-400">(Latest: <code class="bg-background px-2 py-0.5 rounded text-emerald-500">{{ $version->getDaemon() }}</code>)</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-background/50 rounded-lg p-4 flex items-center space-x-4">
                            <div class="p-3 bg-accent-purple/10 rounded-lg">
                                <i class="fas fa-microchip text-accent-purple text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-400">CPU Threads</div>
                                <div data-attr="info-cpus" class="text-lg font-semibold text-gray-100">
                                    <i class="fas fa-circle-notch fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-background/50 rounded-lg p-4 flex items-center space-x-4">
                        <div class="p-3 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-server text-accent-purple text-xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">System Information</div>
                            <div data-attr="info-system" class="text-lg font-semibold text-gray-100">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($node->description)
                <!-- Description -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Description</h3>
                    </div>
                    <div class="p-5">
                        <pre class="bg-background/50 rounded-lg p-4 text-gray-200">{{ $node->description }}</pre>
                    </div>
                </div>
            @endif

            <!-- Danger Zone -->
            <div class="glass-card rounded-lg overflow-hidden border border-red-500/20">
                <div class="p-5 border-b border-gray-700">
                    <h3 class="text-xl font-semibold text-red-500">Danger Zone</h3>
                </div>
                <div class="p-5">
                    <p class="text-gray-400">Deleting a node is an irreversible action and will immediately remove this node from the panel. There must be no servers associated with this node in order to continue.</p>
                    <div class="mt-4">
                        <form action="{{ route('admin.nodes.view.delete', $node->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit"
                                    {{ ($node->servers_count < 1) ?: 'disabled' }}
                                    class="px-4 py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Node
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Quick Stats -->
            @if($node->maintenance_mode)
                <div class="glass-card rounded-lg p-5 border-2 border-yellow-500/20 bg-yellow-500/5">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-yellow-500/10 rounded-lg">
                            <i class="fas fa-wrench text-yellow-500 text-xl"></i>
                        </div>
                        <div>
                            <div class="text-sm text-yellow-500">Maintenance Mode</div>
                            <div class="text-lg font-semibold text-yellow-500">Active</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Resource Usage -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-5 border-b border-gray-700">
                    <h3 class="text-xl font-semibold gradient-text">Resource Usage</h3>
                </div>
                <div class="p-5 space-y-6">
                    <!-- Memory -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-400">Memory</span>
                            <span class="text-sm text-gray-400">{{ $stats['memory']['value'] }} / {{ $stats['memory']['max'] }} MiB</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-accent-purple transition-all duration-300"
                                 style="width: {{ $stats['memory']['percent'] }}%"></div>
                        </div>
                    </div>

                    <!-- Disk -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-400">Disk Space</span>
                            <span class="text-sm text-gray-400">{{ $stats['disk']['value'] }} / {{ $stats['disk']['max'] }} MiB</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-accent-blue transition-all duration-300"
                                 style="width: {{ $stats['disk']['percent'] }}%"></div>
                        </div>
                    </div>

                    <!-- Servers -->
                    <div class="bg-background/50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">Total Servers</div>
                            <div class="text-2xl font-bold text-gray-100">{{ $node->servers_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function escapeHtml(str) {
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

        (function getInformation() {
            $.ajax({
                method: 'GET',
                url: '/admin/nodes/view/{{ $node->id }}/system-information',
                timeout: 5000,
            }).done(function (data) {
                $('[data-attr="info-version"]').html(escapeHtml(data.version));
                $('[data-attr="info-system"]').html(escapeHtml(data.system.type) + ' (' + escapeHtml(data.system.arch) + ') <code class="bg-background px-2 py-0.5 rounded text-accent-blue">' + escapeHtml(data.system.release) + '</code>');
                $('[data-attr="info-cpus"]').html(data.system.cpus);
            }).fail(function (jqXHR) {
                // Handle error
            }).always(function() {
                setTimeout(getInformation, 10000);
            });
        })();
    </script>
@endsection
