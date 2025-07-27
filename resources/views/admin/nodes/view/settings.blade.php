@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Settings
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
                            <small class="block mt-1 text-base font-normal text-gray-400">Configure node settings and resources</small>
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
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Overview
            </a>
            <a href="{{ route('admin.nodes.view.settings', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium rounded-t-lg bg-accent-purple text-white border-b-2 border-accent-purple">
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

    <form action="{{ route('admin.nodes.view.settings', $node->id) }}" method="POST">
    @if(\Pterodactyl\Models\MythicaluiTheme::getValue('enable_memory_converter', 'true') === 'true')
    <div class="mb-2 lg:col-span-3">
        @include('admin.components.memory-calculator')
    </div>
    @endif
        <div class="grid grid-cols-3 gap-8">
            <!-- Main Settings -->
            <div class="col-span-2 space-y-8">
                <!-- Basic Information -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Basic Information</h3>
                    </div>
                    <div class="p-5 space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-200">Node Name</label>
                            <div class="mt-1">
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $node->name) }}"
                                       class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                <p class="mt-1 text-xs text-gray-400">
                                    Character limits: <code class="px-1.5 py-0.5 bg-background-darker rounded">a-zA-Z0-9_.-</code> and <code class="px-1.5 py-0.5 bg-background-darker rounded">[Space]</code>
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-200">Description</label>
                            <div class="mt-1">
                                <textarea id="description"
                                          name="description"
                                          rows="3"
                                          class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $node->description }}</textarea>
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location_id" class="block text-sm font-medium text-gray-200">Location</label>
                            <div class="mt-1 relative">
                                <select name="location_id"
                                        id="location_id"
                                        class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 appearance-none cursor-pointer">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ (old('location_id', $node->location_id) === $location->id) ? 'selected' : '' }}>
                                            {{ $location->long }} ({{ $location->short }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Node Configuration -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Node Configuration</h3>
                    </div>
                    <div class="p-5 space-y-6">
                        <!-- FQDN -->
                        <div>
                            <label for="fqdn" class="block text-sm font-medium text-gray-200">
                                Fully Qualified Domain Name
                            </label>
                            <div class="mt-1">
                                <input type="text"
                                       id="fqdn"
                                       name="fqdn"
                                       value="{{ old('fqdn', $node->fqdn) }}"
                                       class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Please enter domain name (e.g <code class="px-1.5 py-0.5 bg-background-darker rounded">node.example.com</code>) to be used for connecting to the daemon.
                                </p>
                            </div>
                        </div>

                        <!-- Communication Protocol -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-200 mb-2">Communication Protocol</label>
                                <div class="space-y-2">
                                    <label class="flex items-center p-3 bg-background/50 rounded-lg cursor-pointer group">
                                        <input type="radio"
                                               name="scheme"
                                               value="https"
                                               {{ (old('scheme', $node->scheme) === 'https') ? 'checked' : '' }}
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center
                                                    peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <div>
                                            <div class="text-gray-200 group-hover:text-white transition-colors">Use SSL Connection</div>
                                            <div class="text-xs text-gray-400">Recommended for security</div>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-3 bg-background/50 rounded-lg cursor-pointer group">
                                        <input type="radio"
                                               name="scheme"
                                               value="http"
                                               {{ (old('scheme', $node->scheme) !== 'https') ? 'checked' : '' }}
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center
                                                    peer-checked:border-red-500 peer-checked:bg-red-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-red-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <div>
                                            <div class="text-gray-200 group-hover:text-white transition-colors">Use HTTP Connection</div>
                                            <div class="text-xs text-gray-400">Not recommended for production</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-200 mb-2">Behind Proxy</label>
                                <div class="space-y-2">
                                    <label class="flex items-center p-3 bg-background/50 rounded-lg cursor-pointer group">
                                        <input type="radio"
                                               name="behind_proxy"
                                               value="1"
                                               {{ (old('behind_proxy', $node->behind_proxy) == true) ? 'checked' : '' }}
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center
                                                    peer-checked:border-accent-purple peer-checked:bg-accent-purple/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-accent-purple scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <div>
                                            <div class="text-gray-200 group-hover:text-white transition-colors">Behind Proxy</div>
                                            <div class="text-xs text-gray-400">Skip certificate check on boot</div>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-3 bg-background/50 rounded-lg cursor-pointer group">
                                        <input type="radio"
                                               name="behind_proxy"
                                               value="0"
                                               {{ (old('behind_proxy', $node->behind_proxy) == false) ? 'checked' : '' }}
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded-full mr-3 flex items-center justify-center
                                                    peer-checked:border-accent-purple peer-checked:bg-accent-purple/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-accent-purple scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <div>
                                            <div class="text-gray-200 group-hover:text-white transition-colors">Direct Connection</div>
                                            <div class="text-xs text-gray-400">Normal certificate handling</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Resource Allocation -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Resource Allocation</h3>
                    </div>
                    <div class="p-5 space-y-6">
                        <!-- Memory -->
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Memory</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Total Memory</label>
                                    <div class="relative">
                                        <input type="text"
                                               name="memory"
                                               value="{{ old('memory', $node->memory) }}"
                                               class="w-full pl-4 pr-12 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            MiB
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Overallocate</label>
                                    <div class="relative">
                                        <input type="text"
                                               name="memory_overallocate"
                                               value="{{ old('memory_overallocate', $node->memory_overallocate) }}"
                                               class="w-full pl-4 pr-8 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Disk -->
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Disk Space</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Total Disk</label>
                                    <div class="relative">
                                        <input type="text"
                                               name="disk"
                                               value="{{ old('disk', $node->disk) }}"
                                               class="w-full pl-4 pr-12 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            MiB
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Overallocate</label>
                                    <div class="relative">
                                        <input type="text"
                                               name="disk_overallocate"
                                               value="{{ old('disk_overallocate', $node->disk_overallocate) }}"
                                               class="w-full pl-4 pr-8 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daemon Settings -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Daemon Settings</h3>
                    </div>
                    <div class="p-5 space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Daemon Ports</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">Daemon Port</label>
                                    <input type="text"
                                           name="daemonListen"
                                           value="{{ old('daemonListen', $node->daemonListen) }}"
                                           class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1">SFTP Port</label>
                                    <input type="text"
                                           name="daemonSFTP"
                                           value="{{ old('daemonSFTP', $node->daemonSFTP) }}"
                                           class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                The daemon runs its own SFTP container. Do not use the same port as your physical server's SSH process.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Save Changes -->
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Save Changes</h3>
                    </div>
                    <div class="p-5">
                        <label class="flex items-center p-3 bg-background/50 rounded-lg cursor-pointer group mb-4">
                            <input type="checkbox"
                                   name="reset_secret"
                                   class="hidden peer" />
                            <div class="w-5 h-5 border-2 rounded mr-3 flex items-center justify-center
                                        peer-checked:border-accent-purple peer-checked:bg-accent-purple/20
                                        border-gray-600 transition-colors">
                                <i class="fas fa-check text-accent-purple scale-0 peer-checked:scale-100 transition-transform"></i>
                            </div>
                            <div>
                                <div class="text-gray-200 group-hover:text-white transition-colors">Reset Daemon Master Key</div>
                                <div class="text-xs text-gray-400">This will invalidate the current master key</div>
                            </div>
                        </label>

                        {!! method_field('PATCH') !!}
                        {!! csrf_field() !!}
                        <button type="submit"
                                class="w-full px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('[data-toggle="popover"]').popover({
            placement: 'auto'
        });
    </script>
@endsection
