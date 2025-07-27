@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Delete
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Delete this server from the panel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Delete</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Safe Delete -->
    <div>
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-red-500/10 rounded-lg">
                        <i class="fas fa-trash text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100">Safely Delete Server</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="alert flex items-center p-4 rounded-lg bg-red-500/10 text-red-500 mb-4">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                        <p class="font-medium">Warning: Destructive Action</p>
                        <p class="text-sm mt-1">This action will delete all server data including files and users.</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400 mb-6">
                    This action will attempt to delete the server from both the panel and daemon. If either one reports an error the action will be cancelled.
                </p>
                <form id="deleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button id="deletebtn" type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash mr-2"></i>
                        Safely Delete Server
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Force Delete -->
    <div>
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-red-500/10 rounded-lg">
                        <i class="fas fa-bomb text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-100">Force Delete Server</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="alert flex items-center p-4 rounded-lg bg-red-500/10 text-red-500 mb-4">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <div>
                        <p class="font-medium">Warning: Highly Destructive Action</p>
                        <p class="text-sm mt-1">This may leave dangling files on your daemon if it reports an error.</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400 mb-6">
                    This action will attempt to delete the server from both the panel and daemon. If the daemon does not respond, or reports an error the deletion will continue.
                </p>
                <form id="forcedeleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="force_delete" value="1" />
                    <button id="forcedeletebtn" type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-bomb mr-2"></i>
                        Force Delete Server
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    function showDeleteConfirmation(formId) {
        const form = document.getElementById(formId);
        const isForceDelete = formId === 'forcedeleteform';

        const title = isForceDelete ? 'Force Delete Server' : 'Delete Server';
        const text = 'Are you sure you want to delete this server? This action cannot be undone and all data will be permanently removed.';

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    document.getElementById('deletebtn').addEventListener('click', function(e) {
        e.preventDefault();
        showDeleteConfirmation('deleteform');
    });

    document.getElementById('forcedeletebtn').addEventListener('click', function(e) {
        e.preventDefault();
        showDeleteConfirmation('forcedeleteform');
    });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
