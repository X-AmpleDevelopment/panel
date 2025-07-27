@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Databases
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Manage server databases.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Databases</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')

<div class="alert flex items-center p-4 rounded-lg bg-accent-blue/10 text-accent-blue mb-6">
    <i class="fas fa-info-circle mr-3"></i>
    Database passwords can be viewed when  <a href="/server/{{ $server->uuidShort }}/databases" class="underline hover:text-accent-purple transition-colors">visiting this server</a>  on the front-end.
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Active Databases -->
    <div class="lg:col-span-2">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-database text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Active Databases</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-background-darker bg-opacity-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Database</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Connections From</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Host</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Max Connections</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider w-24">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @foreach($server->databases as $database)
                            <tr class="hover:bg-background-darker/50 transition-colors">
                                <td class="px-6 py-4">
                                    <code class="px-2 py-1 bg-background rounded text-gray-400 text-sm">{{ $database->database }}</code>
                                </td>
                                <td class="px-6 py-4 text-gray-200">{{ $database->username }}</td>
                                <td class="px-6 py-4 text-gray-200">{{ $database->remote }}</td>
                                <td class="px-6 py-4">
                                    <code class="px-2 py-1 bg-background rounded text-gray-400 text-sm">{{ $database->host->host }}:{{ $database->host->port }}</code>
                                </td>
                                <td class="px-6 py-4 text-gray-200">
                                    @if($database->max_connections != null)
                                        {{ $database->max_connections }}
                                    @else
                                        <span class="text-gray-400">Unlimited</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button data-action="reset-password" data-id="{{ $database->id }}"
                                                class="px-2 py-1 bg-accent-blue text-white rounded hover:bg-accent-blue/80 transition-colors">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                        <button data-action="remove" data-id="{{ $database->id }}"
                                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Database -->
    <div class="lg:col-span-1">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <i class="fas fa-plus text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Create Database</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.servers.view.database', $server->id) }}" method="POST">
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pDatabaseHostId" class="block text-sm font-medium text-gray-200 mb-2">Database Host</label>
                        <select id="pDatabaseHostId"
                                name="database_host_id"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            @foreach($hosts as $host)
                                <option value="{{ $host->id }}">{{ $host->name }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Select the host database server that this database should be created on.
                        </p>
                    </div>

                    <div>
                        <label for="pDatabaseName" class="block text-sm font-medium text-gray-200 mb-2">Database</label>
                        <div class="flex rounded-lg border border-gray-700 bg-background overflow-hidden">
                            <span class="px-3 py-2 bg-background-darker text-gray-400 border-r border-gray-700">s{{ $server->id }}_</span>
                            <input type="text"
                                   id="pDatabaseName"
                                   name="database"
                                   class="flex-1 px-3 py-2 bg-background text-white focus:ring-0 border-0 outline-none"
                                   placeholder="database" />
                        </div>
                    </div>

                    <div>
                        <label for="pRemote" class="block text-sm font-medium text-gray-200 mb-2">Connections</label>
                        <input type="text"
                               id="pRemote"
                               name="remote"
                               value="%"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            This should reflect the IP address that connections are allowed from. Uses standard MySQL notation. If unsure leave as <code class="px-1.5 py-0.5 bg-background-darker rounded">%</code>.
                        </p>
                    </div>

                    <div>
                        <label for="pmax_connections" class="block text-sm font-medium text-gray-200 mb-2">Concurrent Connections</label>
                        <input type="text"
                               id="pmax_connections"
                               name="max_connections"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Leave empty for unlimited concurrent connections.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-background-darker/50 flex items-center justify-between">
                    <p class="text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Credentials will be generated automatically.
                    </p>
                    <div>
                        {!! csrf_field() !!}
                        <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                            Create Database
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
        function showAlert(type, title, message) {
            return Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK',
                confirmButtonColor: type === 'error' ? '#EF4444' : '#10B981'
            });
        }

        document.querySelectorAll('[data-action="remove"]').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const id = this.dataset.id;

                const result = await Swal.fire({
                    title: 'Delete Database?',
                    text: 'This action cannot be undone and all data will be permanently deleted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    confirmButtonColor: '#EF4444',
                    cancelButtonText: 'Cancel'
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/admin/servers/view/{{ $server->id }}/database/${id}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="_token"]').content
                            }
                        });

                        if (!response.ok) throw new Error('Failed to delete database');

                        this.closest('tr').remove();
                        showAlert('success', 'Success', 'Database has been deleted successfully.');
                    } catch (error) {
                        console.error(error);
                        showAlert('error', 'Error', 'Failed to delete database.');
                    }
                }
            });
        });

        document.querySelectorAll('[data-action="reset-password"]').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const icon = this.querySelector('i');

                try {
                    icon.classList.add('fa-spin');
                    this.disabled = true;

                    const response = await fetch(`/admin/servers/view/{{ $server->id }}/database`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="_token"]').content,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ database: id })
                    });

                    if (!response.ok) throw new Error('Failed to reset password');

                    showAlert('success', 'Success', 'Database password has been reset successfully.');
                } catch (error) {
                    console.error(error);
                    showAlert('error', 'Error', 'Failed to reset database password.');
                } finally {
                    icon.classList.remove('fa-spin');
                    this.disabled = false;
                }
            });
        });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
