@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Build Details
@endsection

@section('content')
@include('admin.servers.partials.navigation')

<form action="{{ route('admin.servers.view.build', $server->id) }}" method="POST">
    @if(\Pterodactyl\Models\MythicaluiTheme::getValue('enable_memory_converter', 'true') === 'true')
    <div class="mb-6">
        @include('admin.components.memory-calculator')
    </div>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Resource Management -->
        <div>
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                     <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-microchip text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Resource Management</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="cpu" class="block text-sm font-medium text-gray-200 mb-2">CPU Limit</label>
                        <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                            <input type="text"
                                   id="cpu"
                                   name="cpu"
                                   value="{{ old('cpu', $server->cpu) }}"
                                   class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                            <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">%</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Each <em>virtual</em> core is <code class="px-1.5 py-0.5 bg-background-darker rounded">100%</code>. Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited.
                        </p>
                    </div>

                    <div>
                        <label for="threads" class="block text-sm font-medium text-gray-200 mb-2">CPU Pinning</label>
                        <input type="text"
                               id="threads"
                               name="threads"
                               value="{{ old('threads', $server->threads) }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            <strong>Advanced:</strong> Enter specific CPU cores, e.g. <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code>, <code class="px-1.5 py-0.5 bg-background-darker rounded">0-1,3</code>
                        </p>
                    </div>

                    <div>
                        <label for="memory" class="block text-sm font-medium text-gray-200 mb-2">Memory</label>
                        <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                            <input type="text"
                                   id="memory"
                                   name="memory"
                                   value="{{ old('memory', $server->memory) }}"
                                   class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                            <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited memory.
                        </p>
                    </div>

                    <div>
                        <label for="swap" class="block text-sm font-medium text-gray-200 mb-2">Swap</label>
                        <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                            <input type="text"
                                   id="swap"
                                   name="swap"
                                   value="{{ old('swap', $server->swap) }}"
                                   class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                            <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> to disable, <code class="px-1.5 py-0.5 bg-background-darker rounded">-1</code> for unlimited.
                        </p>
                    </div>

                    <div>
                        <label for="disk" class="block text-sm font-medium text-gray-200 mb-2">Disk Space</label>
                        <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                            <input type="text"
                                   id="disk"
                                   name="disk"
                                   value="{{ old('disk', $server->disk) }}"
                                   class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                            <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Server will be stopped if it exceeds this limit. Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited.
                        </p>
                    </div>

                    <div>
                        <label for="io" class="block text-sm font-medium text-gray-200 mb-2">Block IO Weight</label>
                        <input type="text"
                               id="io"
                               name="io"
                               value="{{ old('io', $server->io) }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            <strong>Advanced:</strong> IO performance relative to other containers (<code class="px-1.5 py-0.5 bg-background-darker rounded">10-1000</code>).
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">OOM Killer</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio"
                                       name="oom_disabled"
                                       value="0"
                                       @if(!$server->oom_disabled) checked @endif
                                       class="text-red-500 border-gray-700 focus:ring-red-500" />
                                <span class="ml-2 text-sm text-gray-200">Enabled</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio"
                                       name="oom_disabled"
                                       value="1"
                                       @if($server->oom_disabled) checked @endif
                                       class="text-emerald-500 border-gray-700 focus:ring-emerald-500" />
                                <span class="ml-2 text-sm text-gray-200">Disabled</span>
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Enabling may cause server processes to exit unexpectedly.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <!-- Feature Limits -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-blue/10 rounded-lg">
                            <i class="fas fa-sliders-h text-accent-blue"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Feature Limits</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="database_limit" class="block text-sm font-medium text-gray-200 mb-2">Database Limit</label>
                            <input type="text"
                                   id="database_limit"
                                   name="database_limit"
                                   value="{{ old('database_limit', $server->database_limit) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of databases.
                            </p>
                        </div>

                        <div>
                            <label for="allocation_limit" class="block text-sm font-medium text-gray-200 mb-2">Allocation Limit</label>
                            <input type="text"
                                   id="allocation_limit"
                                   name="allocation_limit"
                                   value="{{ old('allocation_limit', $server->allocation_limit) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of allocations.
                            </p>
                        </div>

                        <div>
                            <label for="backup_limit" class="block text-sm font-medium text-gray-200 mb-2">Backup Limit</label>
                            <input type="text"
                                   id="backup_limit"
                                   name="backup_limit"
                                   value="{{ old('backup_limit', $server->backup_limit) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of backups.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Allocation Management -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-network-wired text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Allocation Management</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pAllocation" class="block text-sm font-medium text-gray-200 mb-2">Default Port</label>
                        <select id="pAllocation"
                                name="allocation_id"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            @foreach ($assigned as $assignment)
                                <option value="{{ $assignment->id }}"
                                        @if($assignment->id === $server->allocation_id) selected @endif>
                                    {{ $assignment->alias }}:{{ $assignment->port }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            The default connection address for this server.
                        </p>
                    </div>

                    <div>
                        <label for="pAddAllocations" class="block text-sm font-medium text-gray-200 mb-2">Additional Ports</label>
                        <select id="pAddAllocations"
                                name="add_allocations[]"
                                multiple
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 min-h-[120px]">
                            @foreach ($unassigned as $assignment)
                                <option value="{{ $assignment->id }}">
                                    {{ $assignment->alias }}:{{ $assignment->port }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Additional ports to assign to this server. Hold Ctrl/Cmd to select multiple.
                        </p>
                    </div>

                    <div>
                        <label for="pRemoveAllocations" class="block text-sm font-medium text-gray-200 mb-2">Remove Ports</label>
                        <select id="pRemoveAllocations"
                                name="remove_allocations[]"
                                multiple
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 min-h-[120px]">
                            @foreach ($assigned as $assignment)
                                <option value="{{ $assignment->id }}">
                                    {{ $assignment->alias }}:{{ $assignment->port }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Select ports to remove from this server. Hold Ctrl/Cmd to select multiple.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-background-darker/50 flex justify-end">
                    {!! csrf_field() !!}
                    <button type="submit" class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update Configuration
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
