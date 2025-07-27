@extends('layouts.admin')

@section('title')
    Nests &rarr; New Egg
@endsection

@section('content-header')
    <h1 class="text-3xl font-bold text-gray-100">
        New Egg
        <small class="block mt-1 text-base font-normal text-gray-400">Create a new Egg to assign to servers.</small>
    </h1>
    <ol class="flex mt-2 text-sm text-gray-400">
        <li><a href="{{ route('admin.index') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Admin</a></li>
        <li class="mx-2">/</li>
        <li><a href="{{ route('admin.nests') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Nests</a></li>
        <li class="mx-2">/</li>
        <li class="text-gray-200">New Egg</li>
    </ol>
@endsection

@section('content')

<form action="{{ route('admin.nests.egg.new') }}" method="POST">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Basic Configuration -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Basic Configuration</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="pNestId" class="block text-sm font-medium text-gray-200 mb-2">Associated Nest</label>
                    <select name="nest_id"
                            id="pNestId"
                            class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                        @foreach($nests as $nest)
                            <option value="{{ $nest->id }}" {{ old('nest_id') != $nest->id ?: 'selected' }}>
                                {{ $nest->name }} &lt;{{ $nest->author }}&gt;
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Think of a Nest as a category. Put related Eggs in the same Nest.
                    </p>
                </div>

                <div>
                    <label for="pName" class="block text-sm font-medium text-gray-200 mb-2">Name</label>
                    <input type="text"
                           id="pName"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        A human-readable identifier that users will see as their server type.
                    </p>
                </div>

                <div>
                    <label for="pDescription" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                    <textarea id="pDescription"
                              name="description"
                              rows="4"
                              class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ old('description') }}</textarea>
                </div>

                <div class="bg-background/50 rounded-lg p-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox"
                               id="pForceOutgoingIp"
                               name="force_outgoing_ip"
                               value="1"
                               {{ \Pterodactyl\Helpers\Utilities::checked('force_outgoing_ip', 0) }}
                               class="hidden peer" />
                        <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                  peer-checked:border-accent-purple peer-checked:bg-accent-purple/20
                                  border-gray-600 transition-colors">
                            <i class="fas fa-check text-accent-purple scale-0 peer-checked:scale-100 transition-transform"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-200">Force Outgoing IP</span>
                    </label>
                    <p class="mt-2 text-xs text-gray-400">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>
                        Forces outgoing traffic to use server's primary IP. Required for some games with multiple node IPs.
                        <strong class="block mt-1 text-yellow-500">
                            Enabling this disables internal networking between servers on the same node.
                        </strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Docker Configuration -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Docker Configuration</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="pDockerImages" class="block text-sm font-medium text-gray-200 mb-2">Docker Images</label>
                    <textarea id="pDockerImages"
                              name="docker_images"
                              rows="4"
                              placeholder="quay.io/pterodactyl/service"
                              class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ old('docker_images') }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Enter one image per line. Users can select from these if multiple are provided.
                    </p>
                </div>

                <div>
                    <label for="pStartup" class="block text-sm font-medium text-gray-200 mb-2">Startup Command</label>
                    <textarea id="pStartup"
                              name="startup"
                              rows="6"
                              class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ old('startup') }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        The default startup command for new servers. Can be changed per-server.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Management -->
    <div class="glass-card rounded-lg overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-700">
            <h3 class="text-xl font-semibold gradient-text">Process Management</h3>
        </div>

        <div class="p-4 bg-yellow-500/10 border-b border-yellow-500/20">
            <p class="text-sm text-yellow-500">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                All fields are required unless copying settings from another Egg.
            </p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label for="pConfigStop" class="block text-sm font-medium text-gray-200 mb-2">Stop Command</label>
                        <input type="text"
                               id="pConfigStop"
                               name="config_stop"
                               value="{{ old('config_stop') }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Command to stop server processes. Use <code class="px-1 py-0.5 bg-background-darker rounded">^C</code> for SIGINT.
                        </p>
                    </div>

                    <div>
                        <label for="pConfigLogs" class="block text-sm font-medium text-gray-200 mb-2">Log Configuration</label>
                        <div id="configLogsEditor" class="h-48 rounded-lg overflow-hidden border border-gray-700"></div>
                        <textarea name="config_logs" class="hidden">{{ old('config_logs') }}</textarea>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            JSON configuration for log file handling.
                        </p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="pConfigFiles" class="block text-sm font-medium text-gray-200 mb-2">Configuration Files</label>
                        <div id="configFilesEditor" class="h-48 rounded-lg overflow-hidden border border-gray-700"></div>
                        <textarea name="config_files" class="hidden">{{ old('config_files') }}</textarea>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            JSON configuration for file modifications.
                        </p>
                    </div>

                    <div>
                        <label for="pConfigStartup" class="block text-sm font-medium text-gray-200 mb-2">Start Configuration</label>
                        <div id="configStartupEditor" class="h-48 rounded-lg overflow-hidden border border-gray-700"></div>
                        <textarea name="config_startup" class="hidden">{{ old('config_startup') }}</textarea>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            JSON configuration for startup completion detection.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-background-darker/50 flex justify-end">
            {!! csrf_field() !!}
            <button type="submit"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-plus-circle mr-2"></i>
                Create Egg
            </button>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    {!! Theme::js('vendor/ace/ace.js') !!}
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#pNestId').select2({
                placeholder: 'Select a Nest',
                theme: 'dark'
            }).change();

            $('#pConfigFrom').select2({
                placeholder: 'Select an Egg',
                theme: 'dark'
            });

            // Initialize Ace Editors
            const editors = {
                configLogs: ace.edit('configLogsEditor'),
                configFiles: ace.edit('configFilesEditor'),
                configStartup: ace.edit('configStartupEditor')
            };

            // Configure all editors
            Object.values(editors).forEach(editor => {
                editor.setTheme('ace/theme/monokai');
                editor.getSession().setMode('ace/mode/json');
                editor.setShowPrintMargin(false);
                editor.setOptions({
                    fontSize: "12pt",
                    showLineNumbers: true,
                    showGutter: true,
                    enableBasicAutocompletion: true,
                    enableLiveAutocompletion: true,
                    highlightActiveLine: true,
                    displayIndentGuides: true,
                    useWorker: false
                });
            });

            // Handle Nest change
            $('#pNestId').on('change', function (event) {
                $('#pConfigFrom').html('<option value="">None</option>').select2({
                    data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                        return {
                            id: item.id,
                            text: item.name + ' <' + item.author + '>',
                        };
                    }),
                });
            });

            // Handle form submission
            $('form').on('submit', function(e) {
                $('textarea[name="config_logs"]').val(editors.configLogs.getValue());
                $('textarea[name="config_files"]').val(editors.configFiles.getValue());
                $('textarea[name="config_startup"]').val(editors.configStartup.getValue());
            });
        });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        /* Select2 Dark Theme */
        .select2-container--dark .select2-selection--single {
            @apply bg-background border-gray-700 rounded-lg;
        }

        .select2-container--dark .select2-selection--single .select2-selection__rendered {
            @apply text-gray-200;
        }

        .select2-container--dark .select2-dropdown {
            @apply bg-background border-gray-700 rounded-lg;
        }

        .select2-container--dark .select2-results__option {
            @apply text-gray-200;
        }

        .select2-container--dark .select2-results__option--highlighted[aria-selected] {
            @apply bg-accent-purple/20 text-white;
        }

        .select2-container--dark .select2-results__option[aria-selected=true] {
            @apply bg-accent-purple text-white;
        }

        .ace-monokai {
            background-color: rgb(17, 24, 39) !important;
        }
    </style>
@endsection
