@extends('layouts.admin')

@section('title')
    Locations
@endsection

@section('content')
    

    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-map-marker-alt text-accent-purple"></i>
                        </div>
                        <div>
                            Locations
                            <small class="block mt-1 text-base font-normal text-gray-400">All locations that nodes can be assigned to for easier categorization.</small>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="flex items-center space-x-3">
                <button type="button"
                        onclick="toggleView()"
                        class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-all duration-300 group"
                        id="toggle-button">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create New
                </button>
            </div>
        </div>
    </div>

    <!-- List View -->
    <div id="list-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($locations as $location)
            <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                <div class="p-5 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.locations.view', $location->id) }}"
                           class="text-lg font-medium text-gray-100 hover:text-accent-purple transition-colors">
                            {{ $location->short }}
                        </a>
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-map-marker-alt text-accent-purple"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-gray-400 text-sm mb-4">{{ $location->long }}</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-background/50 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-400">Nodes</span>
                                <span class="text-sm font-semibold text-gray-200">
                                    <i class="fas fa-server text-accent-purple mr-2"></i>
                                    {{ $location->nodes_count }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-background/50 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-400">Servers</span>
                                <span class="text-sm font-semibold text-gray-200">
                                    <i class="fas fa-cube text-accent-blue mr-2"></i>
                                    {{ $location->servers_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-5 pb-5">
                    <a href="{{ route('admin.locations.view', $location->id) }}"
                       class="block w-full px-4 py-2 bg-accent-purple/10 text-accent-purple text-center rounded-lg hover:bg-accent-purple/20 transition-colors">
                        Manage Location
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Create Form View -->
    <div id="create-view" class="hidden transition-all duration-300 transform translate-y-4 opacity-0">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">Create New Location</h3>
                    <div class="p-2 bg-accent-purple/10 rounded-lg">
                        <i class="fas fa-map-marker-alt text-accent-purple"></i>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <form action="{{ route('admin.locations') }}" method="POST">
                    <div class="space-y-6">
                        <div>
                            <label for="pShortModal" class="block text-sm font-medium text-gray-200">Short Code</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="pShortModal"
                                       name="short"
                                       required
                                       placeholder="us.nyc.lvl3"
                                       class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                A unique identifier for this location (e.g. <code class="px-1.5 py-0.5 bg-background-darker rounded">us.nyc.lvl3</code>).
                            </p>
                        </div>

                        <div>
                            <label for="pLongModal" class="block text-sm font-medium text-gray-200">Description</label>
                            <div class="relative mt-1">
                                <textarea id="pLongModal"
                                          name="long"
                                          required
                                          rows="3"
                                          placeholder="A detailed description of this location..."
                                          class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"></textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Provide a clear description to help identify this location.
                            </p>
                        </div>

                        <div class="flex justify-end space-x-3">
                            {!! csrf_field() !!}
                            <button type="button"
                                    onclick="toggleView()"
                                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Create Location
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

                // Update button
                toggleButton.innerHTML = '<i class="fas fa-plus-circle mr-2"></i>Create New';
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

                // Update button
                toggleButton.innerHTML = '<i class="fas fa-arrow-left mr-2"></i>Back to List';
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
    </style>
@endsection
