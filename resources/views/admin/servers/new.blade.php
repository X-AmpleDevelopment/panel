@extends('layouts.admin')

@section('title')
    New Server
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-server text-accent-purple"></i>
        </div>
        <div>
            Create New Server
            <small class="block mt-1 text-base font-normal text-gray-400">Add a new server to our panel.</small>
        </div>
    </div>
</h1>
<br>
<form action="{{ route('admin.servers.new') }}" method="POST">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Core Details -->
        <div class="lg:col-span-3">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Core Details</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pName" class="block text-sm font-medium text-gray-200 mb-2">Server Name</label>
                            <input type="text"
                                   id="pName"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                   placeholder="My Cool Server" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Character limits: <code class="px-1.5 py-0.5 bg-background-darker rounded">a-z A-Z 0-9 _ - .</code> and <code class="px-1.5 py-0.5 bg-background-darker rounded">[Space]</code>
                            </p>
                        </div>

                        <div x-data="ownerSelect()" class="relative">
                            <label class="block text-sm font-medium text-gray-200 mb-2">
                                Server Owner <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input type="hidden" name="owner_id" x-model="selectedId">
                                <button type="button"
                                        @click="isOpen = !isOpen"
                                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 flex items-center justify-between">
                                    <div class="flex items-center space-x-3" x-show="!loading">
                                        <template x-if="selectedUser">
                                            <img :src="'https://www.gravatar.com/avatar/' + selectedUser.md5 + '?s=120'"
                                                 class="h-8 w-8 rounded-full"
                                                 alt="User Avatar">
                                        </template>
                                        <div class="text-left">
                                            <div x-text="selectedUser ? selectedUser.name_first + ' ' + selectedUser.name_last : 'Select Owner'"
                                                 class="text-gray-200"></div>
                                            <div x-text="selectedUser ? selectedUser.email : ''"
                                                 class="text-sm text-gray-400"></div>
                                        </div>
                                    </div>
                                    <div x-show="loading" class="flex items-center space-x-2">
                                        <i class="fas fa-circle-notch fa-spin text-gray-400"></i>
                                        <span class="text-gray-400">Loading...</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-400 ml-2"
                                       :class="{ 'transform rotate-180': isOpen }"></i>
                                </button>

                                <div x-show="isOpen"
                                     @click.away="isOpen = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-1"
                                     class="absolute z-50 w-full mt-1 bg-background-darker border border-gray-700 rounded-lg shadow-lg">
                                    <div class="p-2">
                                        <input type="text"
                                               x-model="search"
                                               @input.debounce.300ms="searchUsers"
                                               placeholder="Search by email..."
                                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    </div>
                                    <div class="max-h-60 overflow-y-auto">
                                        <template x-for="user in users" :key="user.id">
                                            <button type="button"
                                                    @click="selectUser(user)"
                                                    class="w-full px-4 py-2 flex items-center space-x-3 hover:bg-accent-purple/10 transition-colors">
                                                <img :src="'https://www.gravatar.com/avatar/' + user.md5 + '?s=120'"
                                                     class="h-8 w-8 rounded-full"
                                                     alt="User Avatar">
                                                <div class="text-left">
                                                    <div x-text="user.name_first + ' ' + user.name_last"
                                                         class="text-gray-200"></div>
                                                    <div x-text="user.email"
                                                         class="text-sm text-gray-400"></div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Email address of the Server Owner
                            </p>
                        </div>

                        <div>
                            <label for="pDescription" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                            <textarea id="pDescription"
                                      name="description"
                                      rows="3"
                                      class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                A brief description of this server
                            </p>
                        </div>

                        <div class="flex items-center">
                            <label class="flex items-center mt-6">
                                <input type="checkbox"
                                       id="pStartOnCreation"
                                       name="start_on_completion"
                                       class="w-4 h-4 text-accent-purple bg-background border-gray-700 rounded focus:ring-accent-purple"
                                       {{ \Pterodactyl\Helpers\Utilities::checked('start_on_completion', 1) }} />
                                <span class="ml-2 text-sm text-gray-200">Start Server when Installed</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Allocation Management -->
        <div class="lg:col-span-3">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-network-wired text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Allocation Management</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="pNodeId" class="block text-sm font-medium text-gray-200 mb-2">Node</label>
                            <select name="node_id"
                                    id="pNodeId"
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                @foreach($locations as $location)
                                    <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}"
                                            @if($location->id === old('location_id')) selected @endif
                                        >{{ $node->name }}</option>
                                    @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                The node which this server will be deployed to
                            </p>
                        </div>

                        <div>
                            <label for="pAllocation" class="block text-sm font-medium text-gray-200 mb-2">Default Port</label>
                            <select id="pAllocation"
                                    name="allocation_id"
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            </select>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                The main allocation assigned to this server
                            </p>
                        </div>

                        <div>
                            <label for="pAllocationAdditional" class="block text-sm font-medium text-gray-200 mb-2">Additional Ports</label>
                            <select id="pAllocationAdditional"
                                    name="allocation_additional[]"
                                    multiple
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 min-h-[120px]">
                            </select>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Additional ports to assign to this server. Hold Ctrl/Cmd to select multiple.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Limits -->
        <div class="lg:col-span-3">
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
                            <label for="pDatabaseLimit" class="block text-sm font-medium text-gray-200 mb-2">Database Limit</label>
                            <input type="text"
                                   id="pDatabaseLimit"
                                   name="database_limit"
                                   value="{{ old('database_limit', 0) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of databases
                            </p>
                        </div>

                        <div>
                            <label for="pAllocationLimit" class="block text-sm font-medium text-gray-200 mb-2">Allocation Limit</label>
                            <input type="text"
                                   id="pAllocationLimit"
                                   name="allocation_limit"
                                   value="{{ old('allocation_limit', 0) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of allocations
                            </p>
                        </div>

                        <div>
                            <label for="pBackupLimit" class="block text-sm font-medium text-gray-200 mb-2">Backup Limit</label>
                            <input type="text"
                                   id="pBackupLimit"
                                   name="backup_limit"
                                   value="{{ old('backup_limit', 0) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximum number of backups
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(\Pterodactyl\Models\MythicaluiTheme::getValue('enable_memory_converter', 'true') === 'true')
    <div class="mb-2 lg:col-span-3">
        @include('admin.components.memory-calculator')
    </div>
    @endif
        <!-- Resource Management -->
        <div class="lg:col-span-3">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-microchip text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Resource Management</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- CPU -->
                        <div>
                            <label for="pCPU" class="block text-sm font-medium text-gray-200 mb-2">CPU Limit</label>
                            <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                                <input type="text"
                                       id="pCPU"
                                       name="cpu"
                                       value="{{ old('cpu', 0) }}"
                                       class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                                <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">%</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited. Each thread is <code class="px-1.5 py-0.5 bg-background-darker rounded">100%</code>
                            </p>
                        </div>

                        <!-- CPU Pinning -->
                        <div>
                            <label for="pThreads" class="block text-sm font-medium text-gray-200 mb-2">CPU Pinning</label>
                            <input type="text"
                                   id="pThreads"
                                   name="threads"
                                   value="{{ old('threads') }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Advanced:</strong> e.g. <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code>, <code class="px-1.5 py-0.5 bg-background-darker rounded">0-1,3</code>
                            </p>
                        </div>

                        <!-- Memory -->
                        <div>
                            <label for="pMemory" class="block text-sm font-medium text-gray-200 mb-2">Memory</label>
                            <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                                <input type="text"
                                       id="pMemory"
                                       name="memory"
                                       value="{{ old('memory') }}"
                                       class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                                <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited memory
                            </p>
                        </div>

                        <!-- Swap -->
                        <div>
                            <label for="pSwap" class="block text-sm font-medium text-gray-200 mb-2">Swap</label>
                            <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                                <input type="text"
                                       id="pSwap"
                                       name="swap"
                                       value="{{ old('swap', 0) }}"
                                       class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                                <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> to disable, <code class="px-1.5 py-0.5 bg-background-darker rounded">-1</code> for unlimited
                            </p>
                        </div>

                        <!-- Disk Space -->
                        <div>
                            <label for="pDisk" class="block text-sm font-medium text-gray-200 mb-2">Disk Space</label>
                            <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                                <input type="text"
                                       id="pDisk"
                                       name="disk"
                                       value="{{ old('disk') }}"
                                       class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none" />
                                <span class="px-3 py-2 bg-background-darker text-gray-400 border-l border-gray-700">MiB</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Set to <code class="px-1.5 py-0.5 bg-background-darker rounded">0</code> for unlimited disk space
                            </p>
                        </div>

                        <!-- Block IO -->
                        <div>
                            <label for="pIO" class="block text-sm font-medium text-gray-200 mb-2">Block IO Weight</label>
                            <input type="text"
                                   id="pIO"
                                   name="io"
                                   value="{{ old('io', 500) }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Advanced:</strong> Value between <code class="px-1.5 py-0.5 bg-background-darker rounded">10-1000</code>
                            </p>
                        </div>

                        <!-- OOM Killer -->
                        <div class="md:col-span-2">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       id="pOomDisabled"
                                       name="oom_disabled"
                                       value="0"
                                       {{ \Pterodactyl\Helpers\Utilities::checked('oom_disabled', 0) }}
                                       class="w-4 h-4 text-accent-purple bg-background border-gray-700 rounded focus:ring-accent-purple" />
                                <span class="text-sm text-gray-200">Enable OOM Killer</span>
                            </label>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Terminates the server if it breaches memory limits
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nest & Docker Configuration -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Nest Configuration -->
                <div>
                    <div class="glass-card rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-accent-blue/10 rounded-lg">
                                    <i class="fas fa-folder text-accent-blue"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-100">Nest Configuration</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="pNestId" class="block text-sm font-medium text-gray-200 mb-2">Nest</label>
                                <select id="pNestId"
                                        name="nest_id"
                                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    @foreach($nests as $nest)
                                        <option value="{{ $nest->id }}"
                                            @if($nest->id === old('nest_id')) selected @endif
                                        >{{ $nest->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Select the Nest for this server
                                </p>
                            </div>

                            <div>
                                <label for="pEggId" class="block text-sm font-medium text-gray-200 mb-2">Egg</label>
                                <select id="pEggId"
                                        name="egg_id"
                                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                </select>
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Select the Egg for this server
                                </p>
                            </div>

                            <div>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox"
                                           id="pSkipScripting"
                                           name="skip_scripts"
                                           value="1"
                                           {{ \Pterodactyl\Helpers\Utilities::checked('skip_scripts', 0) }}
                                           class="w-4 h-4 text-accent-purple bg-background border-gray-700 rounded focus:ring-accent-purple" />
                                    <span class="text-sm text-gray-200">Skip Egg Install Script</span>
                                </label>
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Skip running the Egg's install script
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Docker Configuration -->
                <div>
                    <div class="glass-card rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-accent-blue/10 rounded-lg">
                                    <i class="fab fa-docker text-accent-blue"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-100">Docker Configuration</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="pDefaultContainer" class="block text-sm font-medium text-gray-200 mb-2">Docker Image</label>
                                <select id="pDefaultContainer"
                                        name="image"
                                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                </select>
                                <input type="text"
                                       id="pDefaultContainerCustom"
                                       name="custom_image"
                                       value="{{ old('custom_image') }}"
                                       placeholder="Or enter a custom image..."
                                       class="mt-2 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Select a predefined image or enter a custom one
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Startup Configuration -->
        <div class="lg:col-span-3">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-terminal text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Startup Configuration</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pStartup" class="block text-sm font-medium text-gray-200 mb-2">Startup Command</label>
                        <input type="text"
                               id="pStartup"
                               name="startup"
                               value="{{ old('startup') }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Available variables: <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_MEMORY}}</code>,
                            <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_IP}}</code>,
                            <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_PORT}}</code>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-200 mb-4">Service Variables</h3>
                        <div id="appendVariablesTo" class="space-y-4"></div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-background-darker/50 flex justify-end">
                    {!! csrf_field() !!}
                    <button type="submit" class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Create Server
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}

    <script>
        function ownerSelect() {
            return {
                isOpen: false,
                loading: false,
                search: '',
                users: [],
                selectedId: '',
                selectedUser: null,
                async searchUsers() {
                    if (this.search.length < 2) return;

                    this.loading = true;
                    try {
                        const response = await fetch(`/admin/users/accounts.json?filter[email]=${this.search}`);
                        const data = await response.json();
                        this.users = data;
                    } catch (error) {
                        console.error('Error fetching users:', error);
                    }
                    this.loading = false;
                },
                selectUser(user) {
                    this.selectedUser = user;
                    this.selectedId = user.id;
                    this.isOpen = false;
                }
            }
        }

    </script>
 <script type="application/javascript">
        $(document).ready(function() {
            // Persist 'Node' select2
            @if (old('node_id'))
                $('#pNodeId').val('{{ old('node_id') }}').change();

                // Persist 'Default Allocation' select2
                @if (old('allocation_id'))
                    $('#pAllocation').val('{{ old('allocation_id') }}').change();
                @endif
                // END Persist 'Default Allocation' select2

                // Persist 'Additional Allocations' select2
                @if (old('allocation_additional'))
                    const additional_allocations = [];

                    @for ($i = 0; $i < count(old('allocation_additional')); $i++)
                        additional_allocations.push('{{ old('allocation_additional.'.$i)}}');
                    @endfor

                    $('#pAllocationAdditional').val(additional_allocations).change();
                @endif
                // END Persist 'Additional Allocations' select2
            @endif
            // END Persist 'Node' select2

            // Persist 'Nest' select2
            @if (old('nest_id'))
                $('#pNestId').val('{{ old('nest_id') }}').change();

                // Persist 'Egg' select2
                @if (old('egg_id'))
                    $('#pEggId').val('{{ old('egg_id') }}').change();
                @endif
                // END Persist 'Egg' select2
            @endif
            // END Persist 'Nest' select2
        });
    </script>
        <script type="application/javascript">
        // Persist 'Service Variables'
        function serviceVariablesUpdated(eggId, ids) {
            @if (old('egg_id'))
                // Check if the egg id matches.
                if (eggId != '{{ old('egg_id') }}') {
                    return;
                }

                @if (old('environment'))
                    @foreach (old('environment') as $key => $value)
                        $('#' + ids['{{ $key }}']).val('{{ $value }}');
                    @endforeach
                @endif
            @endif
            @if(old('image'))
                $('#pDefaultContainer').val('{{ old('image') }}');
            @endif
        }
        // END Persist 'Service Variables'
        $(document).ready(function() {
    $('#pNestId').select2({
        placeholder: 'Select a Nest',
    }).change();

    $('#pEggId').select2({
        placeholder: 'Select a Nest Egg',
    });

    $('#pPackId').select2({
        placeholder: 'Select a Service Pack',
    });

    $('#pNodeId').select2({
        placeholder: 'Select a Node',
    }).change();

    $('#pAllocation').select2({
        placeholder: 'Select a Default Allocation',
    });

    $('#pAllocationAdditional').select2({
        placeholder: 'Select Additional Allocations',
    });
});

let lastActiveBox = null;
$(document).on('click', function (event) {
    if (lastActiveBox !== null) {
        lastActiveBox.removeClass('box-primary');
    }

    lastActiveBox = $(event.target).closest('.box');
    lastActiveBox.addClass('box-primary');
});

$('#pNodeId').on('change', function () {
    currentNode = $(this).val();
    $.each(Pterodactyl.nodeData, function (i, v) {
        if (v.id == currentNode) {
            $('#pAllocation').html('').select2({
                data: v.allocations,
                placeholder: 'Select a Default Allocation',
            });

            updateAdditionalAllocations();
        }
    });
});

$('#pNestId').on('change', function (event) {
    $('#pEggId').html('').select2({
        data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
            return {
                id: item.id,
                text: item.name,
            };
        }),
    }).change();
});

$('#pEggId').on('change', function (event) {
    let parentChain = _.get(Pterodactyl.nests, $('#pNestId').val(), null);
    let objectChain = _.get(parentChain, 'eggs.' + $(this).val(), null);

    const images = _.get(objectChain, 'docker_images', {})
    $('#pDefaultContainer').html('');
    const keys = Object.keys(images);
    for (let i = 0; i < keys.length; i++) {
        let opt = document.createElement('option');
        opt.value = images[keys[i]];
        opt.innerText = keys[i] + " (" + images[keys[i]] + ")";
        $('#pDefaultContainer').append(opt);
    }

    if (!_.get(objectChain, 'startup', false)) {
        $('#pStartup').val(_.get(parentChain, 'startup', 'ERROR: Startup Not Defined!'));
    } else {
        $('#pStartup').val(_.get(objectChain, 'startup'));
    }

    $('#pPackId').html('').select2({
        data: [{ id: 0, text: 'No Service Pack' }].concat(
            $.map(_.get(objectChain, 'packs', []), function (item, i) {
                return {
                    id: item.id,
                    text: item.name + ' (' + item.version + ')',
                };
            })
        ),
    });

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    const variableIds = {};
    $('#appendVariablesTo').html('');
    $.each(_.get(objectChain, 'variables', []), function (i, item) {
        variableIds[item.env_variable] = 'var_ref_' + item.id;

        let isRequired = (item.required === 1) ? '<span class="px-1.5 py-0.5 bg-red-500/10 text-red-400 text-xs rounded-lg">Required</span>' : '';
        let dataAppend = `
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-cog text-accent-purple"></i>
                            <label for="var_ref_${escapeHtml(item.id)}" class="text-sm font-medium text-gray-200">
                                ${escapeHtml(item.name)}
                            </label>
                        </div>
                        ${isRequired}
                    </div>
                </div>
                <div class="p-4 space-y-3">
                    <input type="text"
                           id="var_ref_${escapeHtml(item.id)}"
                           name="environment[${escapeHtml(item.env_variable)}]"
                           value="${escapeHtml(item.default_value)}"
                           class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                           autocomplete="off" />

                    <div class="text-xs text-gray-400">
                        <p>${escapeHtml(item.description)}</p>

                        <div class="mt-2 flex items-center space-x-4">
                            <div>
                                <span class="font-medium">Variable:</span>
                                <code class="ml-1">${escapeHtml(item.env_variable)}</code>
                            </div>
                            <div>
                                <span class="font-medium">Rules:</span>
                                <code class="ml-1 px-1.5 py-0.5 bg-background-darker rounded">${escapeHtml(item.rules)}</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#appendVariablesTo').append(dataAppend);
    });

    serviceVariablesUpdated($('#pEggId').val(), variableIds);
});

$('#pAllocation').on('change', function () {
    updateAdditionalAllocations();
});

function updateAdditionalAllocations() {
    let currentAllocation = $('#pAllocation').val();
    let currentNode = $('#pNodeId').val();

    $.each(Pterodactyl.nodeData, function (i, v) {
        if (v.id == currentNode) {
            let allocations = [];

            for (let i = 0; i < v.allocations.length; i++) {
                const allocation = v.allocations[i];

                if (allocation.id != currentAllocation) {
                    allocations.push(allocation);
                }
            }

            $('#pAllocationAdditional').html('').select2({
                data: allocations,
                placeholder: 'Select Additional Allocations',
            });
        }
    });
}
</script>


<style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        #appendVariablesTo {
            @apply grid grid-cols-1 md:grid-cols-2 gap-6;
        }
    </style>
@endsection
