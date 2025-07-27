@extends('layouts.admin')

@section('title')
    Database Hosts
@endsection


@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-database text-accent-purple"></i>
            </div>
            <div>
                Database Hosts
                <small class="block mt-1 text-base font-normal text-gray-400">Database hosts that servers can have databases created on.</small>
            </div>
        </div>
    </h1>
    <br>
    <div class="grid grid-cols-12 gap-6">
        <!-- Main Content -->
        <div class="col-span-12">
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <h2 class="text-2xl font-semibold text-gray-100" id="section-title">Host List</h2>
                    <span class="px-3 py-1 rounded-full text-sm bg-accent-purple/10 text-accent-purple" id="host-counter">
                        {{ count($hosts) }} Total
                    </span>
                </div>
                <button type="button"
                        onclick="toggleView()"
                        class="px-5 py-2.5 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors inline-flex items-center"
                        id="toggle-button">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span>Create New</span>
                </button>
            </div>

            <!-- List View -->
            <div id="list-view" class="transition-all duration-300 transform">
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($hosts as $host)
                        <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50 hover:shadow-lg hover:shadow-accent-purple/10 transition-all duration-300">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                            <i class="fas fa-database text-accent-purple"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.databases.view', $host->id) }}"
                                               class="text-lg font-medium text-gray-200 hover:text-accent-purple transition-colors">
                                                {{ $host->name }}
                                            </a>
                                            <div class="flex items-center space-x-3 mt-1 text-sm text-gray-400">
                                                <span class="flex items-center">
                                                    <i class="fas fa-network-wired mr-2"></i>
                                                    {{ $host->host }}:{{ $host->port }}
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-user mr-2"></i>
                                                    {{ $host->username }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-6">
                                        <div class="text-right">
                                            <span class="px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded-full">
                                                {{ $host->databases_count }} Databases
                                            </span>
                                            <div class="mt-2 text-sm text-gray-400">
                                                @if(! is_null($host->node))
                                                    <a href="{{ route('admin.nodes.view', $host->node->id) }}"
                                                       class="text-accent-blue hover:text-accent-purple transition-colors">
                                                        <i class="fas fa-server mr-1"></i>
                                                        {{ $host->node->name }}
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">
                                                        <i class="fas fa-unlink mr-1"></i>
                                                        No Node
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.databases.view', $host->id) }}"
                                           class="p-2 text-gray-400 hover:text-accent-purple transition-colors">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Create Form View -->
            <div id="create-view" class="hidden transition-all duration-300 transform translate-y-4 opacity-0">
                <div class="mb-6">
                    <p class="mt-1 text-sm text-gray-400">Configure a new database host for allocating databases to servers.</p>
                </div>

                <form action="{{ route('admin.databases') }}" method="POST">
                    <div class="glass-card rounded-lg p-6 space-y-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="pName" class="block text-sm font-medium text-gray-200">Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           name="name"
                                           required
                                           id="pName"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    A short identifier used to distinguish this location from others. Must be between 1 and 60 characters.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label for="pNodeId" class="block text-sm font-medium text-gray-200">Linked Node</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-server text-gray-400"></i>
                                    </div>
                                    <select name="node_id"
                                            id="pNodeId"
                                            required
                                            class="w-full pl-10 pr-10 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 appearance-none cursor-pointer">
                                        <option value="" class="bg-background-darker">None</option>
                                        @foreach($locations as $location)
                                            <optgroup label="{{ $location->short }}" class="text-gray-400 bg-background-darker">
                                                @foreach($location->nodes as $node)
                                                    <option value="{{ $node->id }}" class="text-white bg-background-darker">{{ $node->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <i class="fas fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    This setting does nothing other than default to this database host when adding a database to a server on the selected node.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label for="pHost" class="block text-sm font-medium text-gray-200">Host</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-network-wired text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           name="host"
                                           id="pHost"
                                           required
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The IP address or FQDN that should be used when attempting to connect to this MySQL host.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label for="pPort" class="block text-sm font-medium text-gray-200">Port</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-plug text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           name="port"
                                           id="pPort"
                                           required
                                           value="3306"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The port that MySQL is running on for this host.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label for="pUsername" class="block text-sm font-medium text-gray-200">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                           name="username"
                                           id="pUsername"
                                           required
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The username of an account that has enough permissions to create new users and databases.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label for="pPassword" class="block text-sm font-medium text-gray-200">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password"
                                           name="password"
                                           id="pPassword"
                                           class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The password to the account defined.
                                </p>
                            </div>
                        </div>

                        <div class="p-4 bg-amber-500/10 text-amber-500 rounded-lg text-sm">
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-exclamation-triangle mt-1"></i>
                                <div>
                                    <p>The account defined for this database host <strong>must</strong> have the <code class="px-1.5 py-0.5 bg-amber-500/20 rounded">WITH GRANT OPTION</code> permission. If the defined account does not have this permission requests to create databases <em>will</em> fail.</p>
                                    <p class="mt-2"><strong>Do not use the same account details for MySQL that you have defined for this panel.</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            {!! csrf_field() !!}
                            <button type="submit" class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Create Database Host
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
            const hostCounter = document.getElementById('host-counter');
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
                sectionTitle.textContent = 'Host List';
                hostCounter.classList.remove('hidden');
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
                sectionTitle.textContent = 'Create New Database Host';
                hostCounter.classList.add('hidden');
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

        /* Custom Select Styling */
        select {
            background-image: none !important;
        }

        select:focus {
            @apply outline-none;
        }

        /* Style optgroup */
        optgroup {
            @apply font-semibold;
            padding: 0.5rem 0;
        }

        /* Style options */
        option {
            @apply py-2 px-4;
        }

        /* Webkit specific styles */
        select::-webkit-scrollbar {
            width: 8px;
        }

        select::-webkit-scrollbar-track {
            @apply bg-background-darker;
        }

        select::-webkit-scrollbar-thumb {
            @apply bg-accent-purple/50 rounded-full;
        }

        select::-webkit-scrollbar-thumb:hover {
            @apply bg-accent-purple;
        }

        /* Firefox specific styles */
        select {
            scrollbar-width: thin;
            scrollbar-color: theme('colors.accent-purple') theme('colors.background.darker');
        }
    </style>
@endsection
