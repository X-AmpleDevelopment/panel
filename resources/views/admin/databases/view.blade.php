@extends('layouts.admin')

@section('title')
    Database Host: {{ $host->name }}
@endsection

@section('content')
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-br from-accent-purple to-accent-blue rounded-xl shadow-lg">
                    <i class="fas fa-database text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-100">{{ $host->name }}</h1>
                    <p class="text-base text-gray-400 mt-1">Database Host Configuration</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-sm">
                    <i class="fas fa-circle text-xs mr-2"></i>Online
                </span>
                <a href="{{ route('admin.databases') }}" class="text-gray-400 hover:text-accent-purple transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="glass-card rounded-xl p-4 border border-gray-700/50">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-database text-accent-purple"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total Databases</p>
                    <p class="text-xl font-bold gradient-text">{{ $databases->total() }}</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-xl p-4 border border-gray-700/50">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-accent-blue/10 rounded-lg">
                    <i class="fas fa-server text-accent-blue"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Port</p>
                    <p class="text-xl font-bold gradient-text">{{ $host->port }}</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-xl p-4 border border-gray-700/50">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-green-500/10 rounded-lg">
                    <i class="fas fa-network-wired text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Host Address</p>
                    <p class="text-xl font-bold gradient-text">{{ $host->host }}</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-xl p-4 border border-gray-700/50">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-amber-500/10 rounded-lg">
                    <i class="fas fa-user-shield text-amber-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Username</p>
                    <p class="text-xl font-bold gradient-text">{{ $host->username }}</p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.databases.view', $host->id) }}" method="POST">
        <div class="grid grid-cols-12 gap-6">
            <!-- Configuration Section -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Host Configuration -->
                <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                    <i class="fas fa-cog text-accent-purple"></i>
                                </div>
                                <h3 class="text-xl font-semibold gradient-text">Host Configuration</h3>
                            </div>
                            <span class="px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded-full">
                                Settings
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="pName" class="block text-sm font-medium text-gray-200">Display Name</label>
                                <div class="relative rounded-lg">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="text" id="pName" name="name" value="{{ old('name', $host->name) }}"
                                        class="w-full pl-10 px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="pPort" class="block text-sm font-medium text-gray-200">Port</label>
                                <div class="relative rounded-lg">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-plug text-gray-400"></i>
                                    </div>
                                    <input type="text" id="pPort" name="port" value="{{ old('port', $host->port) }}"
                                        class="w-full pl-10 px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>

                            <div class="col-span-2 space-y-2">
                                <label for="pHost" class="block text-sm font-medium text-gray-200">Host Address</label>
                                <div class="relative rounded-lg">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-network-wired text-gray-400"></i>
                                    </div>
                                    <input type="text" id="pHost" name="host" value="{{ old('host', $host->host) }}"
                                        class="w-full pl-10 px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The IP address or FQDN that should be used when attempting to connect to this MySQL host.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Associated Databases -->
                <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-accent-blue/10 flex items-center justify-center">
                                    <i class="fas fa-database text-accent-blue"></i>
                                </div>
                                <h3 class="text-xl font-semibold gradient-text">Associated Databases</h3>
                            </div>
                            <span class="px-3 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-full">
                                {{ $databases->total() }} Total
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-background/50">
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase">Server</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase">Database</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase">Username</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase">Connections</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase">Limit</th>
                                        <th class="px-4 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700/50">
                                    @foreach($databases as $database)
                                        <tr class="hover:bg-background/50 transition-colors">
                                            <td class="px-4 py-3">
                                                <a href="{{ route('admin.servers.view', $database->getRelation('server')->id) }}"
                                                   class="text-accent-blue hover:text-accent-purple transition-colors">
                                                    {{ $database->getRelation('server')->name }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-3">
                                                <code class="px-2 py-1 bg-background/50 rounded-lg text-sm text-gray-200">
                                                    {{ $database->database }}
                                                </code>
                                            </td>
                                            <td class="px-4 py-3">
                                                <code class="px-2 py-1 bg-background/50 rounded-lg text-sm text-gray-200">
                                                    {{ $database->username }}
                                                </code>
                                            </td>
                                            <td class="px-4 py-3">
                                                <code class="px-2 py-1 bg-background/50 rounded-lg text-sm text-gray-200">
                                                    {{ $database->remote }}
                                                </code>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($database->max_connections != null)
                                                    <span class="px-2 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-lg">
                                                        {{ $database->max_connections }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs bg-gray-500/10 text-gray-400 rounded-lg">
                                                        Unlimited
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <a href="{{ route('admin.servers.view.database', $database->getRelation('server')->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors">
                                                    <i class="fas fa-wrench text-xs mr-2"></i>
                                                    <span class="text-xs font-medium">Manage</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($databases->hasPages())
                            <div class="mt-4 flex justify-center">
                                {!! $databases->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Side Column -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Authentication -->
                <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center">
                                <i class="fas fa-lock text-green-500"></i>
                            </div>
                            <h3 class="text-xl font-semibold gradient-text">Authentication</h3>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="pUsername" class="block text-sm font-medium text-gray-200">Username</label>
                                <div class="relative rounded-lg">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" id="pUsername" name="username" value="{{ old('username', $host->username) }}"
                                        class="w-full pl-10 px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="pPassword" class="block text-sm font-medium text-gray-200">Password</label>
                                <div class="relative rounded-lg">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <input type="password" id="pPassword" name="password"
                                        class="w-full pl-10 px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                </div>
                                <p class="text-xs text-gray-400">Leave blank to keep current password.</p>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-amber-500/10 rounded-lg">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                                <div class="text-sm text-amber-500/90">
                                    <p>Account must have the <code class="px-1.5 py-0.5 bg-amber-500/20 rounded">WITH GRANT OPTION</code> permission.</p>
                                    <p class="mt-2">Do not use panel's database credentials.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                <i class="fas fa-save text-accent-purple"></i>
                            </div>
                            <h3 class="text-xl font-semibold gradient-text">Actions</h3>
                        </div>

                        {!! csrf_field() !!}

                        <div class="space-y-3">
                            <button type="submit" name="_method" value="PATCH"
                                class="w-full px-4 py-2.5 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors inline-flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>

                            <button type="submit" name="_method" value="DELETE"
                                class="w-full px-4 py-2.5 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors inline-flex items-center justify-center">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete Host
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            @apply bg-background-darker rounded-full;
        }

        ::-webkit-scrollbar-thumb {
            @apply bg-accent-purple/50 rounded-full hover:bg-accent-purple transition-colors;
        }
    </style>
@endsection
