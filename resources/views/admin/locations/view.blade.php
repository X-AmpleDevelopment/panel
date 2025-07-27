@extends('layouts.admin')

@section('title')
    Locations &rarr; {{ $location->short }}
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-map-marker-alt text-accent-purple"></i>
            </div>
            <div>
                {{ $location->short }}
                <small class="block mt-1 text-base font-normal text-gray-400">{{ str_limit($location->long, 75) }}</small>
            </div>
        </div>
    </h1>
    <br>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Nodes</p>
                    <h3 class="text-2xl font-bold text-gray-100 mt-1">{{ $location->nodes->count() }}</h3>
                </div>
                <div class="p-3 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-server text-accent-purple"></i>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Servers</p>
                    <h3 class="text-2xl font-bold text-gray-100 mt-1">{{ $location->nodes->sum(fn($node) => $node->servers->count()) }}</h3>
                </div>
                <div class="p-3 bg-accent-blue/10 rounded-lg">
                    <i class="fas fa-cube text-accent-blue"></i>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Location ID</p>
                    <code class="text-lg font-mono text-gray-100 mt-1">{{ $location->id }}</code>
                </div>
                <div class="p-3 bg-emerald-500/10 rounded-lg">
                    <i class="fas fa-fingerprint text-emerald-500"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Location Details -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Location Details</h3>
            </div>
            <form action="{{ route('admin.locations.view', $location->id) }}" method="POST">
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pShort" class="block text-sm font-medium text-gray-200 mb-2">Short Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-code text-gray-400"></i>
                            </div>
                            <input type="text"
                                   id="pShort"
                                   name="short"
                                   value="{{ $location->short }}"
                                   class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: <code class="px-1 py-0.5 bg-background-darker rounded">us.nyc.lvl3</code>
                        </p>
                    </div>

                    <div>
                        <label for="pLong" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 text-gray-400">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <textarea id="pLong"
                                     name="long"
                                     rows="4"
                                     class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $location->long }}</textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            A detailed description of this location.
                        </p>
                    </div>
                </div>

                <div class="p-6 bg-background-darker/50 flex items-center justify-between">
                    <button type="submit"
                            name="action"
                            value="delete"
                            class="group px-4 py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                        <i class="fas fa-trash-alt mr-2 group-hover:animate-bounce"></i>
                        Delete Location
                    </button>
                    <div class="flex items-center space-x-3">
                        {!! csrf_field() !!}
                        {!! method_field('PATCH') !!}
                        <button type="submit"
                                name="action"
                                value="edit"
                                class="group px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            <i class="fas fa-save mr-2 group-hover:animate-bounce"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Nodes List -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Connected Nodes</h3>
            </div>
            <div class="p-6 space-y-4">
                @forelse($location->nodes as $node)
                    <div class="bg-background-darker/50 rounded-lg p-4 hover:bg-background-darker transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-2 bg-accent-purple/10 rounded-lg">
                                    <i class="fas fa-server text-accent-purple"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.nodes.view', $node->id) }}"
                                       class="text-gray-100 hover:text-accent-purple transition-colors font-medium">
                                        {{ $node->name }}
                                    </a>
                                    <div class="flex items-center mt-1 space-x-3 text-sm">
                                        <code class="px-2 py-0.5 bg-background rounded text-gray-400">
                                            {{ $node->fqdn }}
                                        </code>
                                        <span class="px-2 py-0.5 bg-accent-blue/10 text-accent-blue rounded-full flex items-center">
                                            <i class="fas fa-cube mr-1"></i>
                                            {{ $node->servers->count() }} Servers
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.nodes.view', $node->id) }}"
                               class="p-2 text-gray-400 hover:text-accent-purple transition-colors">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <div class="bg-accent-purple/10 rounded-full p-3 w-12 h-12 flex items-center justify-center mx-auto">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                        <h3 class="mt-4 text-gray-200 font-medium">No Nodes Found</h3>
                        <p class="mt-1 text-sm text-gray-400">This location doesn't have any nodes assigned yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .group:hover .group-hover\:animate-bounce {
            animation: bounce 0.5s infinite;
        }
    </style>
@endsection
