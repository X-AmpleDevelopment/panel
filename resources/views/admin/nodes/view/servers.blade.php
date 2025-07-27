@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Servers
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
                            <small class="block mt-1 text-base font-normal text-gray-400">Manage servers assigned to this node</small>
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
               class="px-5 py-2.5 text-sm font-medium rounded-t-lg bg-accent-purple text-white border-b-2 border-accent-purple">
                Servers
            </a>
        </div>
    </div>

    <div class="glass-card rounded-lg overflow-hidden">
        <div class="p-5 border-b border-gray-700">
            <h3 class="text-xl font-semibold gradient-text">Process Manager</h3>
        </div>
        <div class="p-5">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs uppercase bg-background/50">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Server Name</th>
                            <th class="p-3">Owner</th>
                            <th class="p-3">Service</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servers as $server)
                            <tr class="border-b border-gray-700 last:border-0" data-server="{{ $server->uuid }}">
                                <td class="p-3">
                                    <code class="px-2 py-1 bg-background rounded text-accent-blue">{{ $server->uuidShort }}</code>
                                </td>
                                <td class="p-3">
                                    <a href="{{ route('admin.servers.view', $server->id) }}"
                                       class="text-gray-200 hover:text-accent-purple transition-colors">
                                        {{ $server->name }}
                                    </a>
                                </td>
                                <td class="p-3">
                                    <a href="{{ route('admin.users.view', $server->owner_id) }}"
                                       class="text-accent-blue hover:text-accent-purple transition-colors">
                                        {{ $server->user->username }}
                                    </a>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-gray-200">{{ $server->nest->name }}</span>
                                        <span class="text-gray-400">&bull;</span>
                                        <span class="text-gray-400">{{ $server->egg->name }}</span>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.servers.view', $server->id) }}"
                                           class="px-2 py-1 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($servers->hasPages())
                <div class="mt-4 flex justify-center">
                    {{ $servers->render() }}
                </div>
            @endif
        </div>
    </div>
@endsection
