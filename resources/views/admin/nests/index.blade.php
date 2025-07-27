@extends('layouts.admin')

@section('title')
    Nests
@endsection

@section('content-header')

    <ol class="flex mt-2 text-sm text-gray-400">
        <li><a href="{{ route('admin.index') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Admin</a></li>
        <li class="mx-2">/</li>
        <li class="text-gray-200">Nests</li>
    </ol>
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-folder text-accent-purple"></i>
            </div>
            <div>
                Nests
                <small class="block mt-1 text-base font-normal text-gray-400">All nests currently available on this system.</small>
            </div>
        </div>
    </h1><br>


    <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <h2 class="text-2xl font-semibold text-gray-100" id="section-title">Configured Nests</h2>
            <span class="px-3 py-1 rounded-full text-sm bg-accent-purple/10 text-accent-purple" id="nest-counter">
                {{ count($nests) }} Total
            </span>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button"
                    onclick="toggleView('import')"
                    class="px-4 py-2 bg-accent-blue text-white rounded-lg hover:bg-accent-blue/80 transition-colors"
                    id="import-button">
                <i class="fas fa-upload mr-2"></i>
                Import Egg
            </button>
            <button type="button"
                    onclick="toggleView('create')"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors"
                    id="create-button">
                <i class="fas fa-plus-circle mr-2"></i>
                Create New
            </button>
        </div>
    </div>

    <!-- List View -->
    <div id="list-view" class="transition-all duration-300 transform">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-background-darker bg-opacity-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Nest Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-200 uppercase tracking-wider">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @foreach($nests as $nest)
                            <tr class="hover:bg-background-darker/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                                            <i class="fas fa-folder text-accent-purple"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.nests.view', $nest->id) }}"
                                               class="text-gray-100 hover:text-accent-purple transition-colors font-medium">
                                                {{ $nest->name }}
                                            </a>
                                            <div class="mt-1 flex items-center space-x-2 text-xs">
                                                <code class="px-2 py-0.5 bg-background rounded text-gray-400">ID: {{ $nest->id }}</code>
                                                <span class="text-gray-400">by</span>
                                                <span class="text-accent-blue">{{ $nest->author }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-200">
                                    {{ $nest->description }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-6">
                                        <div class="text-center">
                                            <span class="px-3 py-1 inline-flex items-center rounded-full text-sm bg-accent-purple/10 text-accent-purple">
                                                <i class="fas fa-egg mr-2"></i>
                                                {{ $nest->eggs_count }}
                                            </span>
                                            <p class="mt-1 text-xs text-gray-400">Eggs</p>
                                        </div>
                                        <div class="text-center">
                                            <span class="px-3 py-1 inline-flex items-center rounded-full text-sm bg-accent-blue/10 text-accent-blue">
                                                <i class="fas fa-server mr-2"></i>
                                                {{ $nest->servers_count }}
                                            </span>
                                            <p class="mt-1 text-xs text-gray-400">Servers</p>
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

    <!-- Import Egg View -->
    <div id="import-view" class="hidden transition-all duration-300 transform translate-y-4 opacity-0">
        <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold gradient-text">Import an Egg</h3>
                    <p class="mt-1 text-sm text-gray-400">Import a new egg configuration from a JSON file.</p>
                </div>
                <div class="p-2 rounded-full bg-accent-blue/10 text-accent-blue">
                    <i class="fas fa-upload text-xl"></i>
                </div>
            </div>

            <!-- Warning Message -->
            <div class="mb-6">
                <div class="glass-card rounded-lg p-4 border-l-4 border-amber-500 bg-amber-500/5">
                    <div class="flex items-start space-x-4">
                        <div class="p-1">
                            <i class="fas fa-exclamation-triangle text-amber-500 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-amber-500">
                                Eggs are a powerful feature of Pterodactyl Panel that allow for extreme flexibility and configuration. Please note that while powerful, modifying an egg wrongly can very easily brick your servers and cause more problems. Please avoid editing our default eggs — those provided by <code class="px-1.5 py-0.5 bg-amber-500/10 rounded">support@pterodactyl.io</code> — unless you are absolutely sure of what you are doing.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.nests.egg.import') }}" method="POST" enctype="multipart/form-data">
                <div class="space-y-6">
                    <div>
                        <label for="pImportFile" class="block text-sm font-medium text-gray-200">
                            Egg File <span class="text-red-400">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-700 border-dashed rounded-lg hover:border-accent-purple transition-colors">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-upload text-gray-400 text-2xl mb-3"></i>
                                <div class="flex text-sm text-gray-400">
                                    <label for="pImportFile"
                                           class="relative cursor-pointer rounded-md font-medium text-accent-blue hover:text-accent-purple focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-accent-purple">
                                        <span>Upload a file</span>
                                        <input id="pImportFile"
                                               name="import_file"
                                               type="file"
                                               required
                                               accept="application/json"
                                               class="sr-only" />
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-400">JSON file up to 1MB</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="pImportToNest" class="block text-sm font-medium text-gray-200">
                            Associated Nest <span class="text-red-400">*</span>
                        </label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-folder text-gray-400"></i>
                            </div>
                            <select id="pImportToNest"
                                    name="import_to_nest"
                                    required
                                    class="w-full pl-10 pr-10 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 appearance-none cursor-pointer">
                                @foreach($nests as $nest)
                                    <option value="{{ $nest->id }}" class="bg-background-darker">{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Select the nest that this egg will be associated with.
                        </p>
                    </div>

                    <div class="flex justify-end pt-4">
                        {!! csrf_field() !!}
                        <button type="submit" class="px-4 py-2 bg-accent-blue text-white rounded-lg hover:bg-accent-blue/80 transition-colors">
                            <i class="fas fa-upload mr-2"></i>
                            Import Egg
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
        function toggleView(view = null) {
            const listView = document.getElementById('list-view');
            const importView = document.getElementById('import-view');
            const sectionTitle = document.getElementById('section-title');
            const nestCounter = document.getElementById('nest-counter');
            const importButton = document.getElementById('import-button');
            const createButton = document.getElementById('create-button');

            // Helper function to reset buttons
            const resetButtons = () => {
                importButton.innerHTML = '<i class="fas fa-upload mr-2"></i>Import Egg';
                importButton.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                importButton.classList.add('bg-accent-blue', 'hover:bg-accent-blue/80');

                createButton.innerHTML = '<i class="fas fa-plus-circle mr-2"></i>Create New';
                createButton.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                createButton.classList.add('bg-accent-purple', 'hover:bg-accent-purple/80');
            };

            if (listView.classList.contains('hidden')) {
                // Switch to List View
                [importView].forEach(view => {
                    view.classList.add('opacity-0', 'translate-y-4');
                });

                setTimeout(() => {
                    [importView].forEach(view => view.classList.add('hidden'));
                    listView.classList.remove('hidden');
                    setTimeout(() => {
                        listView.classList.remove('opacity-0', 'translate-y-4');
                    }, 50);
                }, 300);

                // Update UI elements
                sectionTitle.textContent = 'Configured Nests';
                nestCounter.classList.remove('hidden');
                resetButtons();
            } else {
                // Switch to specified view
                listView.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    listView.classList.add('hidden');
                    if (view === 'import') {
                        importView.classList.remove('hidden');
                        setTimeout(() => {
                            importView.classList.remove('opacity-0', 'translate-y-4');
                        }, 50);

                        // Update UI elements
                        sectionTitle.textContent = 'Import Egg';
                        importButton.innerHTML = '<i class="fas fa-arrow-left mr-2"></i>Back to List';
                        importButton.classList.remove('bg-accent-blue', 'hover:bg-accent-blue/80');
                        importButton.classList.add('bg-gray-500', 'hover:bg-gray-600');
                    } else if (view === 'create') {
                        window.location.href = "{{ route('admin.nests.new') }}";
                        return;
                    }
                    nestCounter.classList.add('hidden');
                }, 300);
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
