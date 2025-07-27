@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Mounts
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Manage server mounts.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Mounts</li>
    </ol>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')

    <div class="glass-card rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-accent-purple/10 rounded-lg">
                        <i class="fas fa-hdd text-accent-purple"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100">Available Mounts</h3>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-background-darker bg-opacity-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Source</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Target</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider w-20">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @foreach ($mounts as $mount)
                        <tr class="hover:bg-background-darker/50 transition-colors">
                            <td class="px-6 py-4">
                                <code class="px-2 py-1 bg-background rounded text-gray-400 text-sm">{{ $mount->id }}</code>
                            </td>
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
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <code class="px-2 py-1 bg-background rounded text-gray-400 text-sm">{{ $mount->source }}</code>
                            </td>
                            <td class="px-6 py-4">
                                <code class="px-2 py-1 bg-background rounded text-gray-400 text-sm">{{ $mount->target }}</code>
                            </td>
                            <td class="px-6 py-4">
                                @if (! in_array($mount->id, $server->mounts->pluck('id')->toArray()))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-blue/10 text-accent-blue">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Unmounted
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-500">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Mounted
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if (! in_array($mount->id, $server->mounts->pluck('id')->toArray()))
                                        <form action="{{ route('admin.servers.view.mounts.store', [ 'server' => $server->id ]) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <input type="hidden" value="{{ $mount->id }}" name="mount_id" />
                                            <button type="submit" class="px-2 py-1 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition-colors">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.servers.view.mounts.delete', [ 'server' => $server->id, 'mount' => $mount->id ]) }}" method="POST">
                                            @method('DELETE')
                                            {!! csrf_field() !!}
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
