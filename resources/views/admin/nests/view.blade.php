@extends('layouts.admin')

@section('title')
Nests &rarr; {{ $nest->name }}
@endsection



@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-folder text-accent-purple"></i>
        </div>
        <div>
            {{ $nest->name }}
            <small
                class="block mt-1 text-base font-normal text-gray-400">{{ str_limit($nest->description, 50) }}</small>
        </div>
    </div>
</h1><br>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Nest Configuration -->
    <form action="{{ route('admin.nests.view', $nest->id) }}" method="POST">
        <div class="glass-card rounded-lg shadow-xl">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">Configuration</h3>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-200 mb-2">
                        Name <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ $nest->name }}"
                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        A descriptive name that encompasses all eggs within this nest.
                    </p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                    <textarea id="description" name="description" rows="7"
                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $nest->description }}</textarea>
                </div>
            </div>

            <div class="p-6 bg-background-darker/50 flex justify-between items-center">
                {!! csrf_field() !!}
                <button type="submit" name="_method" value="DELETE" onclick="return confirmDelete()"
                    class="group px-4 py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                    <i class="fas fa-trash mr-2 group-hover:animate-bounce"></i>
                    Delete Nest
                </button>
                <button type="submit" name="_method" value="PATCH"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    <!-- Nest Information -->
    <div class="glass-card rounded-lg shadow-xl">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold gradient-text">Nest Information</h3>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Nest ID</label>
                <input type="text" value="{{ $nest->id }}"
                    class="w-full px-3 py-2 bg-background text-gray-400 rounded-lg border border-gray-700" readonly />
                <p class="mt-1 text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    A unique ID used for identification of this nest internally and through the API.
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Author</label>
                <input type="text" value="{{ $nest->author }}"
                    class="w-full px-3 py-2 bg-background text-gray-400 rounded-lg border border-gray-700" readonly />
                <p class="mt-1 text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    The author of this nest. Direct questions to them unless this is an official option by <code
                        class="px-1.5 py-0.5 bg-background-darker rounded">support@pterodactyl.io</code>.
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">UUID</label>
                <input type="text" value="{{ $nest->uuid }}"
                    class="w-full px-3 py-2 bg-background text-gray-400 rounded-lg border border-gray-700" readonly />
                <p class="mt-1 text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    A UUID that all servers using this option are assigned for identification purposes.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Eggs List -->
<div class="mt-6">
    <div class="glass-card rounded-lg shadow-xl">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold gradient-text">Nest Eggs</h3>
                <a href="{{ route('admin.nests.egg.new') }}"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>
                    New Egg
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-background-darker bg-opacity-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider">
                            Servers</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @foreach($nest->eggs as $egg)
                        <tr class="hover:bg-background-darker/50 transition-colors">
                            <td class="px-6 py-4">
                                <code class="px-2 py-0.5 bg-background rounded text-gray-400">{{ $egg->id }}</code>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.nests.egg.view', $egg->id) }}"
                                    class="text-gray-200 hover:text-accent-purple transition-colors"
                                    title="{{ $egg->author }}">
                                    {{ $egg->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-200">{{ $egg->description }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <span
                                        class="px-3 py-1 inline-flex items-center rounded-full text-sm bg-accent-purple/10 text-accent-purple">
                                        {{ $egg->servers->count() }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('admin.nests.egg.export', ['egg' => $egg->id]) }}"
                                        class="text-accent-blue hover:text-accent-purple transition-colors"
                                        title="Export Egg">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return Swal.fire({
            title: 'Delete this nest?',
            text: "All associated eggs will also be deleted. This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, delete it!',
            background: '#1B1E25',
            color: '#E5E7EB',
        }).then((result) => {
            return result.isConfirmed;
        });
    }
</script>
@endsection
