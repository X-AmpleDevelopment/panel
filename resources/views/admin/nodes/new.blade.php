@extends('layouts.admin')

@section('title')
    Nodes &rarr; New
@endsection

@section('content-header')
    <h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-server text-accent-purple"></i>
            </div>
            <div>
                New Node
                <small class="block mt-1 text-base font-normal text-gray-400">Create a new local or remote node for servers to be installed to.</small>
            </div>
        </div>
    </h1>
    <ol class="flex mt-2 text-sm text-gray-400">
        <li><a href="{{ route('admin.index') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Admin</a></li>
        <li class="mx-2">/</li>
        <li><a href="{{ route('admin.nodes') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Nodes</a></li>
        <li class="mx-2">/</li>
        <li class="text-gray-200">New</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('admin.nodes.new') }}" method="POST" x-data="nodeCreation">
        <!-- Progress Steps -->
        <div class="glass-card rounded-lg p-6 mb-8 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-700">
                    <div class="h-full bg-accent-purple transition-all duration-500 ease-out"
                         :style="{ width: `${(currentStep / (steps.length - 1)) * 100}%` }"></div>
                </div>
                <template x-for="(step, index) in steps" :key="index">
                    <div class="relative flex flex-col items-center group z-10">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500"
                             :class="{
                                'bg-accent-purple text-white scale-110': currentStep > index,
                                'bg-accent-purple/10 text-accent-purple scale-110': currentStep === index,
                                'bg-gray-700 text-gray-400 scale-100': currentStep < index
                             }">
                            <template x-if="currentStep > index">
                                <i class="fas fa-check transform transition-transform duration-500 scale-110"></i>
                            </template>
                            <template x-if="currentStep <= index">
                                <span x-text="index + 1"></span>
                            </template>
                        </div>
                        <span class="absolute -bottom-6 text-sm whitespace-nowrap transition-all duration-500"
                              :class="{
                                  'text-accent-purple translate-y-0 opacity-100': currentStep >= index,
                                  'text-gray-400 translate-y-1 opacity-50': currentStep < index
                              }"
                              x-text="step"></span>
                    </div>
                </template>
            </div>
            <br>
        </div>
<br>
        <!-- Step Content -->
        <div class="relative">
        @if(\Pterodactyl\Models\MythicaluiTheme::getValue('enable_memory_converter', 'true') === 'true')
    <div class="mb-2 lg:col-span-3">
        @include('admin.components.memory-calculator')
    </div>
    @endif
            <template x-for="(step, index) in steps" :key="index">
                <div x-show="currentStep === index"
                     x-transition:enter="transition-all duration-500 ease-out"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition-all duration-300 ease-in"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="glass-card rounded-lg p-6 mb-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                    <!-- Keep your existing step content here, but remove the x-show directives -->
                    <div x-show="index === 0">
                        <!-- Basic Information content -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-semibold gradient-text">Basic Information</h3>
                                <p class="mt-1 text-sm text-gray-400">Enter the basic details for your new node.</p>
                            </div>
                            <div class="p-2 rounded-full bg-accent-purple/10 text-accent-purple">
                                <i class="fas fa-info-circle text-xl"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Name field -->
                            <div>
                                <label for="pName" class="block text-sm font-medium text-gray-200">Name</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-server text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="pName"
                                           name="name"
                                           required
                                           x-model="formData.name"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="mt-1 text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Character limits: <code class="px-1.5 py-0.5 bg-background-darker rounded">a-zA-Z0-9_.-</code> and <code class="px-1.5 py-0.5 bg-background-darker rounded">[Space]</code>
                                </p>
                            </div>

                            <!-- Description field -->
                            <div>
                                <label for="pDescription" class="block text-sm font-medium text-gray-200">Description</label>
                                <div class="relative mt-1">
                                    <textarea id="pDescription"
                                            name="description"
                                            rows="3"
                                            x-model="formData.description"
                                            class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"></textarea>
                                </div>
                            </div>

                            <!-- Location field -->
                            <div>
                                <label for="pLocationId" class="block text-sm font-medium text-gray-200">Location</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <select name="location_id"
                                            id="pLocationId"
                                            required
                                            x-model="formData.location_id"
                                            class="w-full pl-10 pr-10 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 appearance-none cursor-pointer">
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->short }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <i class="fas fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="index === 1">
                        <!-- Node Configuration content -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-semibold gradient-text">Node Configuration</h3>
                                <p class="mt-1 text-sm text-gray-400">Configure how your node will be accessed.</p>
                            </div>
                            <div class="p-2 rounded-full bg-accent-purple/10 text-accent-purple">
                                <i class="fas fa-cogs text-xl"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Node Visibility -->
                            <div>
                                <label class="block text-sm font-medium text-gray-200 mb-2">Node Visibility</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                               name="public"
                                               value="1"
                                               x-model="formData.public"
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                    peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <span class="text-gray-200">Public</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                               name="public"
                                               value="0"
                                               x-model="formData.public"
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                    peer-checked:border-red-500 peer-checked:bg-red-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-red-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <span class="text-gray-200">Private</span>
                                    </label>
                                </div>
                            </div>

                            <!-- FQDN -->
                            <div>
                                <label for="pFQDN" class="block text-sm font-medium text-gray-200">FQDN</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-globe text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="pFQDN"
                                           name="fqdn"
                                           required
                                           x-model="formData.fqdn"
                                           placeholder="node.example.com"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>

                            <!-- Communication Protocol -->
                            <div>
                                <label class="block text-sm font-medium text-gray-200 mb-2">Communication Protocol</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                               name="scheme"
                                               value="https"
                                               x-model="formData.scheme"
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                    peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <span class="text-gray-200">HTTPS</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio"
                                               name="scheme"
                                               value="http"
                                               x-model="formData.scheme"
                                               class="hidden peer" />
                                        <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                    peer-checked:border-red-500 peer-checked:bg-red-500/20
                                                    border-gray-600 transition-colors">
                                            <i class="fas fa-check text-red-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                        </div>
                                        <span class="text-gray-200">HTTP</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="index === 2">

                        <!-- Resource Allocation content -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-semibold gradient-text">Resource Allocation</h3>
                                <p class="mt-1 text-sm text-gray-400">Configure the resources available on this node.</p>
                            </div>
                            <div class="p-2 rounded-full bg-accent-purple/10 text-accent-purple">
                                <i class="fas fa-microchip text-xl"></i>
                            </div>
                        </div>


                        <div class="space-y-6">
                            <!-- Memory Allocation -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pMemory" class="block text-sm font-medium text-gray-200">Total Memory</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-memory text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pMemory"
                                               name="memory"
                                               required
                                               x-model="formData.memory"
                                               class="w-full pl-10 pr-16 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-400">MiB</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="pMemoryOverallocate" class="block text-sm font-medium text-gray-200">Memory Over-Allocation</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-percent text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pMemoryOverallocate"
                                               name="memory_overallocate"
                                               required
                                               x-model="formData.memory_overallocate"
                                               class="w-full pl-10 pr-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                    </div>
                                </div>
                            </div>

                            <!-- Disk Allocation -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pDisk" class="block text-sm font-medium text-gray-200">Total Disk Space</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-hdd text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pDisk"
                                               name="disk"
                                               required
                                               x-model="formData.disk"
                                               class="w-full pl-10 pr-16 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-400">MiB</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="pDiskOverallocate" class="block text-sm font-medium text-gray-200">Disk Over-Allocation</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-percent text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pDiskOverallocate"
                                               name="disk_overallocate"
                                               required
                                               x-model="formData.disk_overallocate"
                                               class="w-full pl-10 pr-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="index === 3">
                        <!-- Daemon Configuration content -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-semibold gradient-text">Daemon Configuration</h3>
                                <p class="mt-1 text-sm text-gray-400">Configure the daemon settings for this node.</p>
                            </div>
                            <div class="p-2 rounded-full bg-accent-purple/10 text-accent-purple">
                                <i class="fas fa-network-wired text-xl"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Daemon Directory -->
                            <div>
                                <label for="pDaemonBase" class="block text-sm font-medium text-gray-200">Daemon Server File Directory</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-folder text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           id="pDaemonBase"
                                           name="daemonBase"
                                           required
                                           x-model="formData.daemonBase"
                                           value="/var/lib/pterodactyl/volumes"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>

                            <!-- Daemon Ports -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pDaemonListen" class="block text-sm font-medium text-gray-200">Daemon Port</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-network-wired text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pDaemonListen"
                                               name="daemonListen"
                                               required
                                               x-model="formData.daemonListen"
                                               value="8080"
                                               class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                    </div>
                                </div>

                                <div>
                                    <label for="pDaemonSFTP" class="block text-sm font-medium text-gray-200">SFTP Port</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="text"
                                               id="pDaemonSFTP"
                                               name="daemonSFTP"
                                               required
                                               x-model="formData.daemonSFTP"
                                               value="2022"
                                               class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center">
            <button type="button"
                    x-show="currentStep > 0"
                    @click="previousStep()"
                    x-transition:enter="transition-all duration-300 ease-out"
                    x-transition:enter-start="opacity-0 -translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous
            </button>
            <div class="flex space-x-3 ml-auto">
                <button type="button"
                        x-show="currentStep < steps.length - 1"
                        @click="nextStep()"
                        x-transition:enter="transition-all duration-300 ease-out"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    Next
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
                <button type="submit"
                        x-show="currentStep === steps.length - 1"
                        x-transition:enter="transition-all duration-300 ease-out"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create Node
                </button>
            </div>
        </div>

        {!! csrf_field() !!}
    </form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nodeCreation', () => ({
                currentStep: 0,
                steps: ['Basic Information', 'Node Configuration', 'Resource Allocation', 'Daemon Settings'],
                formData: {
                    name: '',
                    description: '',
                    location_id: '',
                    public: '1',
                    fqdn: '',
                    scheme: 'https',
                    behind_proxy: '0',
                    memory: '',
                    memory_overallocate: '',
                    disk: '',
                    disk_overallocate: '',
                    daemonBase: '/var/lib/pterodactyl/volumes',
                    daemonListen: '8080',
                    daemonSFTP: '2022'
                },
                nextStep() {
                    if (this.currentStep < this.steps.length - 1) {
                        this.currentStep++;
                    }
                },
                previousStep() {
                    if (this.currentStep > 0) {
                        this.currentStep--;
                    }
                }
            }))
        })
    </script>
    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
