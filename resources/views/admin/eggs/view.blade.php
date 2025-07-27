@extends('layouts.admin')

@section('title')
Nests &rarr; Egg: {{ $egg->name }}
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-code text-accent-purple"></i>
        </div>
        <div>
            {{ $egg->name }}
            <small class="block mt-1 text-base font-normal text-gray-400">Managing variables for this Egg.</small>
        </div>
    </div>
</h1><br>

<!-- Navigation Tabs -->
<div class="mb-6 border-b border-gray-700">
    <nav class="flex space-x-6">
        <a href="{{ route('admin.nests.egg.view', $egg->id) }}"
            class="py-4 text-accent-purple border-b-2 border-accent-purple font-medium">
            Configuration
        </a>
        <a href="{{ route('admin.nests.egg.variables', $egg->id) }}"
            class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Variables
        </a>
        <a href="{{ route('admin.nests.egg.scripts', $egg->id) }}"
            class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Install Script
        </a>
    </nav>
</div>

<!-- Import Egg Section -->
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" enctype="multipart/form-data" method="POST">
    <div class="glass-card rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex-1 mr-4">
                <h3 class="text-xl font-semibold gradient-text mb-4">Import Egg</h3>
                <div class="relative">
                    <input type="file" name="import_file" class="block w-full text-sm text-gray-400
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-accent-purple/10 file:text-accent-purple
                                      hover:file:bg-accent-purple/20
                                      cursor-pointer" />
                </div>
                <p class="mt-2 text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    Uploading a new JSON file will replace settings but won't affect existing startup strings or Docker
                    images.
                </p>
            </div>
            <div>
                {!! csrf_field() !!}
                <button type="submit" name="_method" value="PUT"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-upload mr-2"></i>
                    Update Egg
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Main Configuration Form -->
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" method="POST">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Basic Information -->
        <div class="glass-card rounded-lg p-6">
            <h3 class="text-xl font-semibold gradient-text mb-6">Basic Information</h3>
            <div class="space-y-6">
                <div>
                    <label for="pName" class="block text-sm font-medium text-gray-200">Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pName" name="name" value="{{ $egg->name }}"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    <p class="mt-1 text-xs text-gray-400">A human-readable identifier for this Egg.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200">UUID</label>
                    <code class="block mt-1 px-3 py-2 rounded-lg bg-background-darker text-gray-200 font-mono text-sm">
                            {{ $egg->uuid }}
                        </code>
                    <p class="mt-1 text-xs text-gray-400">The unique identifier used by the Daemon.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200">Author</label>
                    <code class="block mt-1 px-3 py-2 rounded-lg bg-background-darker text-gray-200 font-mono text-sm">
                            {{ $egg->author }}
                        </code>
                    <p class="mt-1 text-xs text-gray-400">The creator of this Egg version.</p>
                </div>

                <div>
                    <label for="pDockerImages" class="block text-sm font-medium text-gray-200">Docker Images <span
                            class="text-red-500">*</span></label>
                    <textarea id="pDockerImages" name="docker_images" rows="4"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ implode(PHP_EOL, $images) }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">
                        Enter one image per line. Format: <code
                            class="px-1 py-0.5 bg-background-darker rounded">name|image</code><br>
                        Example: <code
                            class="px-1 py-0.5 bg-background-darker rounded">Java 17|ghcr.io/pterodactyl/java:17</code>
                    </p>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="pForceOutgoingIp" name="force_outgoing_ip" value="1"
                        @if($egg->force_outgoing_ip) checked @endif
                        class="w-4 h-4 text-accent-purple bg-background border-gray-700 rounded focus:ring-accent-purple focus:ring-opacity-25" />
                    <label for="pForceOutgoingIp" class="ml-2 block text-sm text-gray-200">
                        Force Outgoing IP
                    </label>
                </div>
                <p class="text-xs text-gray-400">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>
                    Forces outgoing traffic to use the server's primary IP. Required for some games but disables
                    internal networking between servers.
                </p>
            </div>
        </div>

        <!-- Server Configuration -->
        <div class="glass-card rounded-lg p-6">
            <h3 class="text-xl font-semibold gradient-text mb-6">Server Configuration</h3>
            <div class="space-y-6">
                <div>
                    <label for="pDescription" class="block text-sm font-medium text-gray-200">Description</label>
                    <textarea id="pDescription" name="description" rows="3"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $egg->description }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">A detailed description of this Egg.</p>
                </div>

                <div>
                    <label for="pStartup" class="block text-sm font-medium text-gray-200">Startup Command <span
                            class="text-red-500">*</span></label>
                    <textarea id="pStartup" name="startup" rows="3"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ $egg->startup }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">The default startup command for new servers using this Egg.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Configuration -->
    <div class="glass-card rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold gradient-text">Process Configuration</h3>

        </div>

        <div class="bg-yellow-500/10 text-yellow-500 rounded-lg p-4 mb-6">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            These settings are critical for proper daemon operation. Only modify if you understand the system.
            All fields are required unless copying settings from another Egg.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <label for="pConfigStop" class="block text-sm font-medium text-gray-200">Stop Command</label>
                    <input type="text" id="pConfigStop" name="config_stop" value="{{ $egg->config_stop }}"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono" />
                    <p class="mt-1 text-xs text-gray-400">
                        Command to stop the server. Use <code class="px-1 py-0.5 bg-background-darker rounded">^C</code>
                        for SIGINT.
                    </p>
                </div>

                <div>
                    <label for="pConfigLogs" class="block text-sm font-medium text-gray-200">Log Configuration</label>
                    <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" rows="6"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ !is_null($egg->config_logs) ? json_encode(json_decode($egg->config_logs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">JSON configuration for log file handling.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="pConfigFiles" class="block text-sm font-medium text-gray-200">Configuration
                        Files</label>
                    <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" rows="6"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ !is_null($egg->config_files) ? json_encode(json_decode($egg->config_files), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">JSON configuration for file modifications.</p>
                </div>

                <div>
                    <label for="pConfigStartup" class="block text-sm font-medium text-gray-200">Startup
                        Detection</label>
                    <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" rows="6"
                        class="mt-1 block w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono">{{ !is_null($egg->config_startup) ? json_encode(json_decode($egg->config_startup), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">JSON configuration for startup completion detection.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between">
        <div>
            <button type="submit" name="_method" value="DELETE" id="deleteButton"
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                <i class="fas fa-trash mr-2"></i>
                <span class="hidden delete-text">Delete Egg</span>
            </button>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.nests.egg.export', $egg->id) }}"
                class="px-4 py-2 bg-accent-blue text-white rounded-lg hover:bg-accent-blue/80 transition-colors">
                <i class="fas fa-download mr-2"></i>
                Export
            </a>
            <button type="submit" name="_method" value="PATCH"
                class="px-6 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-save mr-2"></i>
                Save Changes
            </button>
        </div>
    </div>

    {!! csrf_field() !!}
</form>
@endsection

@section('footer-scripts')
@parent
<script>
    $('#pConfigFrom').select2({
        theme: 'dark',
        placeholder: 'Copy Settings From...',
        width: '100%'
    });

    $('#deleteButton').on('mouseenter', function () {
        $(this).find('.delete-text').removeClass('hidden');
    }).on('mouseleave', function () {
        $(this).find('.delete-text').addClass('hidden');
    });

    $('textarea[data-action="handle-tabs"]').on('keydown', function (event) {
        if (event.keyCode === 9) {
            event.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
            this.selectionStart = this.selectionEnd = start + 4;
        }
    });
</script>
@endsection
