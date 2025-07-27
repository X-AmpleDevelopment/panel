@extends('layouts.admin')

@section('title')
    Mounts
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-hdd text-accent-purple"></i>
            </div>
            <div>
                Mounts
                <small class="block mt-1 text-base font-normal text-gray-400">Configure and manage additional mount points for servers.</small>
            </div>
        </div>
    </h1>
    <br>
    <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <h2 class="text-2xl font-semibold text-gray-100" id="section-title">Mount List</h2>
            <span class="px-3 py-1 rounded-full text-sm bg-accent-purple/10 text-accent-purple" id="mount-counter">
                {{ count($mounts) }} Total
            </span>
        </div>
        <button type="button"
                onclick="toggleView()"
                class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors"
                id="toggle-button">
            <i class="fas fa-plus-circle mr-2"></i>
            <span>Create New</span>
        </button>
    </div>

    <!-- List View -->
    <div id="list-view" class="transition-all duration-300 transform">
        <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-background-darker bg-opacity-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider w-2/5">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider w-2/5">Source & Target</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @foreach ($mounts as $mount)
                            <tr class="hover:bg-background-darker/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                                            <i class="fas fa-hdd text-accent-purple"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.mounts.view', $mount->id) }}"
                                               class="text-gray-100 hover:text-accent-purple transition-colors font-medium">
                                                {{ $mount->name }}
                                            </a>
                                            <div class="mt-1 flex items-center space-x-2 text-xs">
                                                <code class="px-2 py-0.5 bg-background rounded text-gray-400">ID: {{ $mount->id }}</code>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center space-x-2">
                                            <div class="p-1 bg-accent-purple/10 rounded">
                                                <i class="fas fa-folder text-accent-purple text-xs"></i>
                                            </div>
                                            <code class="text-sm text-gray-200">{{ $mount->source }}</code>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="p-1 bg-accent-blue/10 rounded">
                                                <i class="fas fa-folder-open text-accent-blue text-xs"></i>
                                            </div>
                                            <code class="text-sm text-gray-200">{{ $mount->target }}</code>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-1">
                                        @if($mount->read_only)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-500">
                                                <i class="fas fa-lock mr-1"></i>
                                                Read Only
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-500">
                                                <i class="fas fa-pen mr-1"></i>
                                                Writable
                                            </span>
                                        @endif
                                        @if($mount->user_mountable)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-500">
                                                <i class="fas fa-user mr-1"></i>
                                                User Mountable
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/10 text-red-500">
                                                <i class="fas fa-user-shield mr-1"></i>
                                                Admin Only
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-6">
                                        <div class="text-center">
                                            <span class="px-3 py-1 inline-flex items-center rounded-full text-sm bg-accent-purple/10 text-accent-purple">
                                                <i class="fas fa-egg mr-2"></i>
                                                {{ $mount->eggs_count }}
                                            </span>
                                            <p class="mt-1 text-xs text-gray-400">Eggs</p>
                                        </div>
                                        <div class="text-center">
                                            <span class="px-3 py-1 inline-flex items-center rounded-full text-sm bg-accent-blue/10 text-accent-blue">
                                                <i class="fas fa-server mr-2"></i>
                                                {{ $mount->nodes_count }}
                                            </span>
                                            <p class="mt-1 text-xs text-gray-400">Nodes</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Form View -->
    <div id="create-view" class="hidden transition-all duration-300 transform translate-y-4 opacity-0">
        <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold gradient-text">Create New Mount</h3>
                    <p class="mt-1 text-sm text-gray-400">Configure a new mount point for your servers.</p>
                </div>
                <div class="p-2 rounded-full bg-accent-purple/10 text-accent-purple">
                    <i class="fas fa-hdd text-xl"></i>
                </div>
            </div>

            <form action="{{ route('admin.mounts') }}" method="POST">
                <div class="space-y-6">
                    <div>
                        <label for="pName" class="block text-sm font-medium text-gray-200">Name</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hdd text-gray-400"></i>
                            </div>
                            <input type="text"
                                   id="pName"
                                   name="name"
                                   required
                                   placeholder="Enter mount name..."
                                   class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            A unique identifier for this mount point.
                        </p>
                    </div>

                    <div>
                        <label for="pDescription" class="block text-sm font-medium text-gray-200">Description</label>
                        <div class="relative mt-1">
                            <textarea id="pDescription"
                                    name="description"
                                    required
                                    rows="3"
                                    placeholder="Describe the purpose of this mount point..."
                                    class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"></textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            A brief description of this mount point's purpose.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pSource" class="block text-sm font-medium text-gray-200">Source Path</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-folder text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="pSource"
                                       name="source"
                                       required
                                       placeholder="/host/path"
                                       class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                The source path on the host system.
                            </p>
                        </div>

                        <div>
                            <label for="pTarget" class="block text-sm font-medium text-gray-200">Target Path</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-folder-open text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="pTarget"
                                       name="target"
                                       required
                                       placeholder="/container/path"
                                       class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                The mount path inside containers.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Read Only</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="read_only"
                                           value="0"
                                           checked
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Writable</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="read_only"
                                           value="1"
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-amber-500 peer-checked:bg-amber-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-amber-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Read Only</span>
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Should the mount be read-only in containers?
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">User Mountable</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="user_mountable"
                                           value="0"
                                           checked
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-red-500 peer-checked:bg-red-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-red-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Admin Only</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="user_mountable"
                                           value="1"
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">User Mountable</span>
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Can users mount this themselves?
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        {!! csrf_field() !!}
                        <button type="submit" class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Create Mount
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function toggleView() {
            const listView = document.getElementById('list-view');
            const createView = document.getElementById('create-view');
            const sectionTitle = document.getElementById('section-title');
            const mountCounter = document.getElementById('mount-counter');
            const toggleButton = document.getElementById('toggle-button');

            if (listView.classList.contains('hidden')) {
                // Switch to List View
                createView.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    createView.classList.add('hidden');
                    listView.classList.remove('hidden');
                    setTimeout(() => {
                        listView.classList.remove('opacity-0', 'translate-y-4');
                    }, 50);
                }, 300);

                // Update UI elements
                sectionTitle.textContent = 'Mount List';
                mountCounter.classList.remove('hidden');
                toggleButton.innerHTML = '<i class="fas fa-plus-circle mr-2"></i><span>Create New</span>';
                toggleButton.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                toggleButton.classList.add('bg-accent-purple', 'hover:bg-accent-purple/80');
            } else {
                // Switch to Create View
                listView.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    listView.classList.add('hidden');
                    createView.classList.remove('hidden');
                    setTimeout(() => {
                        createView.classList.remove('opacity-0', 'translate-y-4');
                    }, 50);
                }, 300);

                // Update UI elements
                sectionTitle.textContent = 'Create New Mount';
                mountCounter.classList.add('hidden');
                toggleButton.innerHTML = '<i class="fas fa-arrow-left mr-2"></i><span>Back to List</span>';
                toggleButton.classList.remove('bg-accent-purple', 'hover:bg-accent-purple/80');
                toggleButton.classList.add('bg-gray-500', 'hover:bg-gray-600');
            }
        }
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        /* Transition classes */
        .translate-y-4 {
            transform: translateY(1rem);
        }
    </style>
@endsection
