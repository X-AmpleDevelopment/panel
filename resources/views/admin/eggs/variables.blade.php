@extends('layouts.admin')

@section('title')
    Egg &rarr; {{ $egg->name }} &rarr; Variables
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


<!-- Header Actions -->
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <h2 class="text-2xl font-semibold text-gray-100">Environment Variables</h2>
        <span class="px-3 py-1 rounded-full text-sm bg-accent-purple/10 text-accent-purple">
            {{ $egg->variables->count() }} Total
        </span>
    </div>
    <button type="button"
            onclick="toggleNewVariableForm()"
            class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
        <i class="fas fa-plus-circle mr-2"></i>
        Create New Variable
    </button>
</div>

<!-- New Variable Form -->
<div id="newVariableForm" class="mb-6 hidden">
    <div class="glass-card rounded-lg overflow-hidden">
        <form action="{{ route('admin.nests.egg.variables', $egg->id) }}" method="POST">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">New Environment Variable</h3>
                    <button type="button"
                            onclick="toggleNewVariableForm()"
                            class="text-gray-400 hover:text-gray-200 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Name <span class="text-red-400">*</span></label>
                        <input type="text" name="name" class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" value="{{ old('name') }}"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Environment Variable <span class="text-red-400">*</span></label>
                        <input type="text" name="env_variable" class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" value="{{ old('env_variable') }}" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" rows="2">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Default Value</label>
                        <input type="text" name="default_value" class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" value="{{ old('default_value') }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Input Rules <span class="text-red-400">*</span></label>
                        <input type="text" name="rules" class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" value="{{ old('rules', 'required|string|max:20') }}" />
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: <code class="px-1 py-0.5 bg-background-darker rounded">required|string|max:20</code>
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Permissions</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="options[]" value="user_viewable" class="form-checkbox text-accent-purple rounded border-gray-700 bg-background focus:ring-accent-purple" {{ old('options') && in_array('user_viewable', old('options')) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-200">Users Can View</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="options[]" value="user_editable" class="form-checkbox text-accent-purple rounded border-gray-700 bg-background focus:ring-accent-purple" {{ old('options') && in_array('user_editable', old('options')) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-200">Users Can Edit</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-background-darker/50 flex justify-end space-x-3">
                {!! csrf_field() !!}
                <button type="button"
                        onclick="toggleNewVariableForm()"
                        class="px-4 py-2 text-gray-400 hover:text-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    Create Variable
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="mb-6 border-b border-gray-700">
    <nav class="flex space-x-6">
        <a href="{{ route('admin.nests.egg.view', $egg->id) }}"
           class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Configuration
        </a>
        <a href="{{ route('admin.nests.egg.variables', $egg->id) }}"
           class="py-4 text-accent-purple border-b-2 border-accent-purple font-medium">
            Variables
        </a>
        <a href="{{ route('admin.nests.egg.scripts', $egg->id) }}"
           class="py-4 text-gray-400 hover:text-gray-200 transition-colors">
            Install Script
        </a>
    </nav>
</div>


<!-- Variables Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($egg->variables as $variable)
        <div class="glass-card rounded-lg overflow-hidden">
            <form action="{{ route('admin.nests.egg.variables.edit', ['egg' => $egg->id, 'variable' => $variable->id]) }}" method="POST">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">{{ $variable->name }}</h3>
                        <code class="px-2 py-1 bg-background-darker rounded text-sm text-gray-200">{{ $variable->env_variable }}</code>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ $variable->name }}"
                               class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                        <textarea name="description"
                                  rows="3"
                                  class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $variable->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Environment Variable</label>
                            <input type="text"
                                   name="env_variable"
                                   value="{{ $variable->env_variable }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Default Value</label>
                            <input type="text"
                                   name="default_value"
                                   value="{{ $variable->default_value }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Permissions</label>
                        <select name="options[]" multiple class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            <option value="user_viewable" {{ $variable->user_viewable ? 'selected' : '' }}>Users Can View</option>
                            <option value="user_editable" {{ $variable->user_editable ? 'selected' : '' }}>Users Can Edit</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Input Rules</label>
                        <div class="relative">
                            <input type="text"
                                   name="rules"
                                   value="{{ $variable->rules }}"
                                   class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 font-mono" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <a href="https://laravel.com/docs/validation#available-validation-rules"
                                   target="_blank"
                                   class="text-gray-400 hover:text-accent-purple transition-colors"
                                   title="View Laravel Validation Rules">
                                    <i class="fas fa-question-circle"></i>
                                </a>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: <code class="px-1 py-0.5 bg-background-darker rounded">required|string|max:20</code>
                        </p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-background-darker/50 flex items-center justify-between">
                    <button type="submit"
                            name="_method"
                            value="DELETE"
                            class="px-3 py-1 text-red-500 hover:text-red-400 transition-colors">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        {!! csrf_field() !!}
                        <button type="submit"
                                name="_method"
                                value="PATCH"
                                class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>

@endsection

@section('footer-scripts')
    @parent
    <script>
        function toggleNewVariableForm() {
            const form = document.getElementById('newVariableForm');
            form.classList.toggle('hidden');

            // Scroll form into view if it's being shown
            if (!form.classList.contains('hidden')) {
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
