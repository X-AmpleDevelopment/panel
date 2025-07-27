@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Startup
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Control startup command as well as variables.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Startup</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')

<form action="{{ route('admin.servers.view.startup', $server->id) }}" method="POST">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Startup Command -->
        <div class="lg:col-span-2">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-terminal text-accent-purple"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Startup Command</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pStartup" class="block text-sm font-medium text-gray-200 mb-2">Startup Command</label>
                        <input type="text"
                               id="pStartup"
                               name="startup"
                               value="{{ old('startup', $server->startup) }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Available variables: <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_MEMORY}}</code>,
                            <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_IP}}</code>, and
                            <code class="px-1.5 py-0.5 bg-background-darker rounded">@{{SERVER_PORT}}</code>
                        </p>
                    </div>

                    <div>
                        <label for="pDefaultStartupCommand" class="block text-sm font-medium text-gray-200 mb-2">Default Service Start Command</label>
                        <input type="text"
                               id="pDefaultStartupCommand"
                               readonly
                               class="w-full px-3 py-2 bg-background-darker text-gray-400 rounded-lg border border-gray-700" />
                    </div>
                </div>
                <div class="px-6 py-4 bg-background-darker/50 flex justify-end">
                    {!! csrf_field() !!}
                    <button type="submit" class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Service Configuration -->
        <div>
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-red-500/10 rounded-lg">
                            <i class="fas fa-cogs text-red-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Service Configuration</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div class="alert flex items-center p-4 rounded-lg bg-red-500/10 text-red-500">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        <div>
                            <p class="font-medium">Warning: Destructive Action</p>
                            <p class="text-sm mt-1">Changing any values below will trigger a server reinstall. The server will be stopped immediately to proceed.</p>
                        </div>
                    </div>

                    <div>
                        <label for="pNestId" class="block text-sm font-medium text-gray-200 mb-2">Nest</label>
                        <select name="nest_id"
                                id="pNestId"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            @foreach($nests as $nest)
                                <option value="{{ $nest->id }}" @if($nest->id === $server->nest_id) selected @endif>
                                    {{ $nest->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="pEggId" class="block text-sm font-medium text-gray-200 mb-2">Egg</label>
                        <select name="egg_id"
                                id="pEggId"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                        </select>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input type="checkbox"
                               id="pSkipScripting"
                               name="skip_scripts"
                               value="1"
                               @if($server->skip_scripts) checked @endif
                               class="w-4 h-4 bg-background border-gray-700 rounded text-accent-purple focus:ring-accent-purple" />
                        <label for="pSkipScripting" class="text-sm font-medium text-gray-200">
                            Skip Egg Install Script
                        </label>
                    </div>
                </div>
            </div>

            <!-- Docker Configuration -->
            <div class="glass-card rounded-lg overflow-hidden mt-6">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-accent-blue/10 rounded-lg">
                            <i class="fab fa-docker text-accent-blue"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-100">Docker Configuration</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pDockerImage" class="block text-sm font-medium text-gray-200 mb-2">Image</label>
                        <select id="pDockerImage"
                                name="docker_image"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 mb-3">
                        </select>
                        <input type="text"
                               id="pDockerImageCustom"
                               name="custom_docker_image"
                               value="{{ old('custom_docker_image') }}"
                               placeholder="Or enter a custom image..."
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Variables -->
        <div id="appendVariablesTo"></div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    <script>
    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const eggSelect = document.getElementById('pEggId');
        const nestSelect = document.getElementById('pNestId');
        const dockerImageSelect = document.getElementById('pDockerImage');
        const dockerImageCustom = document.getElementById('pDockerImageCustom');
        const defaultStartupCommand = document.getElementById('pDefaultStartupCommand');
        const variablesContainer = document.getElementById('appendVariablesTo');

        function updateEggData() {
            const selectedEgg = eggSelect.value || eggSelect.options[0]?.value;
            const parentChain = _.get(Pterodactyl.nests, nestSelect.value);
            const objectChain = _.get(parentChain, 'eggs.' + selectedEgg);

            // Update Docker Images
            const images = _.get(objectChain, 'docker_images', []);
            dockerImageSelect.innerHTML = '';
            const keys = Object.keys(images);

            for (let i = 0; i < keys.length; i++) {
                const opt = document.createElement('option');
                opt.value = images[keys[i]];
                opt.innerText = keys[i] + " (" + images[keys[i]] + ")";
                if (objectChain.id === parseInt(Pterodactyl.server.egg_id) && Pterodactyl.server.image == opt.value) {
                    opt.selected = true;
                }
                dockerImageSelect.appendChild(opt);
            }

            // Handle custom docker image
            if (objectChain.id === parseInt(Pterodactyl.server.egg_id)) {
                if (dockerImageSelect.value != Pterodactyl.server.image) {
                    dockerImageCustom.value = Pterodactyl.server.image;
                }
            }

            // Update default startup command
            if (!_.get(objectChain, 'startup', false)) {
                defaultStartupCommand.value = _.get(parentChain, 'startup', 'ERROR: Startup Not Defined!');
            } else {
                defaultStartupCommand.value = _.get(objectChain, 'startup');
            }

            // Update variables
            variablesContainer.innerHTML = '';
            _.get(objectChain, 'variables', []).forEach(function (item) {
                const setValue = _.get(Pterodactyl.server_variables, item.env_variable, item.default_value);
                const isRequired = (item.required === 1) ? '<span class="px-2 py-1 text-xs font-medium bg-red-500/10 text-red-500 rounded-full">Required</span>' : '';

                const variableHtml = `
                <br>
                    <div class="glass-card rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-accent-purple/10 rounded-lg">
                                        <i class="fas fa-code text-accent-purple"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-100">
                                        ${escapeHtml(item.name)} ${isRequired}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <input name="environment[${escapeHtml(item.env_variable)}]"
                                   type="text"
                                   id="egg_variable_${escapeHtml(item.env_variable)}"
                                   value="${escapeHtml(setValue)}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="text-sm text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                ${escapeHtml(item.description)}
                            </p>
                            <div class="flex flex-col space-y-1">
                                <p class="text-xs text-gray-400">
                                    <strong>Variable:</strong>
                                    <code class="px-1.5 py-0.5 bg-background-darker rounded">${escapeHtml(item.env_variable)}</code>
                                </p>
                                <p class="text-xs text-gray-400">
                                    <strong>Rules:</strong>
                                    <code class="px-1.5 py-0.5 bg-background-darker rounded">${escapeHtml(item.rules)}</code>
                                </p>
                            </div>
                        </div>
                    </div>`;

                variablesContainer.insertAdjacentHTML('beforeend', variableHtml);
            });
        }

        // Handle Nest selection change
        nestSelect.addEventListener('change', function() {
            // Clear and populate egg select
            eggSelect.innerHTML = '';
            const eggs = _.get(Pterodactyl.nests, this.value + '.eggs', []);

            Object.values(eggs).forEach(function(egg) {
                const opt = document.createElement('option');
                opt.value = egg.id;
                opt.innerText = egg.name;
                eggSelect.appendChild(opt);
            });

            // Set initial egg value if available
            if (_.isObject(_.get(Pterodactyl.nests, this.value + '.eggs.' + Pterodactyl.server.egg_id))) {
                eggSelect.value = Pterodactyl.server.egg_id;
            }

            updateEggData();
        });

        // Handle Egg selection change
        eggSelect.addEventListener('change', updateEggData);

        // Handle Docker Image selection change
        dockerImageSelect.addEventListener('change', function() {
            dockerImageCustom.value = '';
        });

        // Initial setup
        nestSelect.dispatchEvent(new Event('change'));
    });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
