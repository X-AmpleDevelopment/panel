@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Manage
@endsection

@section('content')
@include('admin.servers.partials.navigation')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Reinstall Server -->
    <div class="glass-card rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-red-500/10 rounded-lg">
                        <i class="fas fa-sync text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100">Reinstall Server</h3>
                </div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-gray-400">
                This will reinstall the server with the assigned service scripts.
                <span class="block mt-1 text-red-400 font-medium">Warning: This could overwrite server data.</span>
            </p>
        </div>
        <div class="px-6 py-4 bg-background-darker/50">
            @if($server->isInstalled())
                <form action="{{ route('admin.servers.view.manage.reinstall', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-sync mr-2"></i>
                        Reinstall Server
                    </button>
                </form>
            @else
                <button class="px-4 py-2 bg-red-500/50 text-white rounded-lg cursor-not-allowed">
                    <i class="fas fa-sync mr-2"></i>
                    Server Must Install Properly to Reinstall
                </button>
            @endif
        </div>
    </div>

    <!-- Install Status -->
    <div class="glass-card rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-accent-blue/10 rounded-lg">
                        <i class="fas fa-toggle-on text-accent-blue"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100">Install Status</h3>
                </div>
            </div>
        </div>
        <div class="p-6">
            <p class="text-gray-400">
                If you need to change the install status from uninstalled to installed, or vice versa, you may do so with the button below.
            </p>
        </div>
        <div class="px-6 py-4 bg-background-darker/50">
            <form action="{{ route('admin.servers.view.manage.toggle', $server->id) }}" method="POST">
                {!! csrf_field() !!}
                <button type="submit" class="px-4 py-2 bg-accent-blue text-white rounded-lg hover:bg-accent-blue/80 transition-colors">
                    <i class="fas fa-toggle-on mr-2"></i>
                    Toggle Install Status
                </button>
            </form>
        </div>
    </div>

    <!-- Suspension Status -->
    @if(! $server->isSuspended())
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-amber-500/10 rounded-lg">
                            <i class="fas fa-ban text-amber-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Suspend Server</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-400">
                    This will suspend the server, stop any running processes, and immediately block the user from being able to access their files or otherwise manage the server.
                </p>
            </div>
            <div class="px-6 py-4 bg-background-darker/50">
                <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="action" value="suspend" />
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors @if(! is_null($server->transfer)) cursor-not-allowed opacity-50 @endif">
                        <i class="fas fa-ban mr-2"></i>
                        Suspend Server
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-check text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Unsuspend Server</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-400">
                    This will unsuspend the server and restore normal user access.
                </p>
            </div>
            <div class="px-6 py-4 bg-background-darker/50">
                <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="action" value="unsuspend" />
                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Unsuspend Server
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Transfer Server -->
    @if(is_null($server->transfer))
        <div class="glass-card rounded-lg overflow-hidden" x-data="transferForm()">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-exchange-alt text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Transfer Server</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-400">
                    Transfer this server to another node connected to this panel.
                    <span class="block mt-1 text-amber-500 font-medium">Warning: This feature has not been fully tested and may have bugs.</span>
                </p>

                @if($canTransfer)
                    <form action="{{ route('admin.servers.view.manage.transfer', $server->id) }}"
                          method="POST"
                          id="transferForm"
                          class="mt-6 space-y-6"
                          x-show="isExpanded"
                          x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0 transform -translate-y-2"
                          x-transition:enter-end="opacity-100 transform translate-y-0"
                          x-transition:leave="transition ease-in duration-150"
                          x-transition:leave-start="opacity-100 transform translate-y-0"
                          x-transition:leave-end="opacity-0 transform -translate-y-2">
                        {!! csrf_field() !!}

                        <div>
                            <label for="pNodeId" class="block text-sm font-medium text-gray-200 mb-2">Node</label>
                            <select name="node_id"
                                    id="pNodeId"
                                    x-model="selectedNode"
                                    @change="fetchAllocations()"
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                @foreach($locations as $location)
                                    <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                        @foreach($location->nodes as $node)
                                            @if($node->id != $server->node_id)
                                                <option value="{{ $node->id }}">{{ $node->name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="pAllocation" class="block text-sm font-medium text-gray-200 mb-2">Default Allocation</label>
                            <select name="allocation_id"
                                    id="pAllocation"
                                    x-model="selectedAllocation"
                                    :disabled="!allocations.length"
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <template x-if="allocations.length">
                                    <template x-for="allocation in allocations" :key="allocation.id">
                                        <option :value="allocation.id" x-text="`${allocation.ip}:${allocation.port}`"></option>
                                    </template>
                                </template>
                                <template x-if="!allocations.length">
                                    <option>No allocations available</option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label for="pAllocationAdditional" class="block text-sm font-medium text-gray-200 mb-2">Additional Allocation(s)</label>
                            <select name="allocation_additional[]"
                                    id="pAllocationAdditional"
                                    multiple
                                    :disabled="!allocations.length"
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <template x-if="allocations.length">
                                    <template x-for="allocation in allocations" :key="allocation.id">
                                        <option :value="allocation.id"
                                                x-text="`${allocation.ip}:${allocation.port}`"
                                                :disabled="allocation.id === selectedAllocation"></option>
                                    </template>
                                </template>
                            </select>
                        </div>
                    </form>
                @endif
            </div>
            <div class="px-6 py-4 bg-background-darker/50 flex items-center justify-end space-x-3">
                @if($canTransfer)
                    <div x-show="!isExpanded">
                        <button type="button"
                                @click="isExpanded = true"
                                class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Start Transfer
                        </button>
                    </div>
                    <div x-show="isExpanded"
                         class="flex items-center space-x-3">
                        <button type="button"
                                @click="isExpanded = false"
                                class="px-4 py-2 text-gray-400 hover:text-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                form="transferForm"
                                class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Transfer Server
                        </button>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <button disabled class="px-4 py-2 bg-emerald-500/50 text-white rounded-lg cursor-not-allowed">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Transfer Server
                        </button>
                        <p class="text-sm text-gray-400">
                            Transferring requires multiple nodes.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-exchange-alt text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Transfer Status</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-400">
                    This server is currently being transferred to another node.
                    <span class="block mt-1 text-gray-200">
                        Transfer initiated at <span class="text-accent-blue">{{ $server->transfer->created_at }}</span>
                    </span>
                </p>
            </div>
            <div class="px-6 py-4 bg-background-darker/50">
                <button class="px-4 py-2 bg-emerald-500/50 text-white rounded-lg cursor-not-allowed">
                    <i class="fas fa-exchange-alt mr-2"></i>
                    Transfer Server
                </button>
            </div>
        </div>
    @endif
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function transferForm() {
            return {
                isExpanded: false,
                selectedNode: null,
                selectedAllocation: null,
                allocations: [],

                async fetchAllocations() {
                    if (!this.selectedNode) return;

                    try {
                        const response = await fetch(`/admin/nodes/${this.selectedNode}/allocations`);
                        const data = await response.json();
                        this.allocations = data.data;
                        this.selectedAllocation = this.allocations[0]?.id;
                    } catch (error) {
                        console.error('Error fetching allocations:', error);
                    }
                }
            }
        }
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
