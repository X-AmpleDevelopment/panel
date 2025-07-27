@extends('layouts.admin')

@section('title')
Nests &rarr; {{ $egg->name }} &rarr; Install Script
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
            class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Configuration
        </a>
        <a href="{{ route('admin.nests.egg.variables', $egg->id) }}"
            class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Variables
        </a>
        <a href="{{ route('admin.nests.egg.scripts', $egg->id) }}"
            class="py-4 text-accent-purple border-b-2 border-accent-purple font-medium">
            Install Script
        </a>
    </nav>
</div>

<form action="{{ route('admin.nests.egg.scripts', $egg->id) }}" method="POST">
    <div class="glass-card rounded-lg overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-700">
            <h3 class="text-xl font-semibold gradient-text">Install Script</h3>
        </div>

        @if(!is_null($egg->copyFrom))
            <div class="p-4 bg-yellow-500/10 border-b border-yellow-500/20">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                    <p class="text-sm text-yellow-500">
                        This service option is copying installation scripts and container options from
                        <a href="{{ route('admin.nests.egg.view', $egg->copyFrom->id) }}"
                            class="text-yellow-500 underline hover:text-yellow-400">
                            {{ $egg->copyFrom->name }}
                        </a>.
                        Any changes you make to this script will not apply unless you select "None" from the dropdown box
                        below.
                    </p>
                </div>
            </div>
        @endif

        <div class="border-b border-gray-700">
            <div id="editor_install" class="h-96 w-full"></div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Copy Script From</label>
                    <select id="pCopyScriptFrom" name="copy_script_from"
                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                        <option value="">None</option>
                        @foreach($copyFromOptions as $opt)
                            <option value="{{ $opt->id }}" {{ $egg->copy_script_from !== $opt->id ?: 'selected' }}>
                                {{ $opt->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        If selected, script above will be ignored and script from selected option will be used.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Script Container</label>
                    <input type="text" name="script_container" value="{{ $egg->script_container }}"
                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono" />
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Docker container to use when running this script.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Script Entrypoint Command</label>
                    <input type="text" name="script_entry" value="{{ $egg->script_entry }}"
                        class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono" />
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        The entrypoint command to use for this script.
                    </p>
                </div>
            </div>

            @if(count($relyOnScript) > 0)
                <div class="flex items-center text-sm text-gray-400">
                    <span class="mr-2">Service options using this script:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($relyOnScript as $rely)
                            <a href="{{ route('admin.nests.egg.view', $rely->id) }}"
                                class="px-2 py-1 bg-background-darker rounded-lg hover:text-accent-purple transition-colors">
                                {{ $rely->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="p-6 bg-background-darker/50 flex justify-end">
            {!! csrf_field() !!}
            <textarea name="script_install" class="hidden"></textarea>
            <button type="submit" name="_method" value="PATCH"
                class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-save mr-2"></i>
                Save Changes
            </button>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
@parent
{!! Theme::js('vendor/ace/ace.js') !!}
{!! Theme::js('vendor/ace/ext-modelist.js') !!}
<script>
    $(document).ready(function () {
        const InstallEditor = ace.edit('editor_install');
        const Modelist = ace.require('ace/ext/modelist')

        // Configure Ace Editor
        InstallEditor.getSession().setMode('ace/mode/sh');
        InstallEditor.getSession().setUseWrapMode(true);
        InstallEditor.setShowPrintMargin(false);
        InstallEditor.setValue(`{{ $egg->script_install }}`, -1);
        InstallEditor.setTheme("ace/theme/monokai");
        InstallEditor.setOptions({
            fontSize: "12pt",
            showLineNumbers: true,
            showGutter: true,
            vScrollBarAlwaysVisible: true,
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
            showPrintMargin: false,
            highlightActiveLine: true,
            displayIndentGuides: true,
            enableSnippets: true,
            wrap: true,
            useWorker: false
        });

        // Handle form submission
        $('form').on('submit', function (e) {
            $('textarea[name="script_install"]').val(InstallEditor.getValue());
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

    #editor_install {
        @apply font-mono;
    }

    .ace-monokai {
        background-color: rgb(17, 24, 39) !important;
    }
</style>
@endsection
