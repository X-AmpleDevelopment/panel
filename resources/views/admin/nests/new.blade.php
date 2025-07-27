@extends('layouts.admin')

@section('title')
    New Nest
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-folder-plus text-accent-purple"></i>
            </div>
            <div>
                New Nest
                <small class="block mt-1 text-base font-normal text-gray-400">Configure a new nest to deploy to all nodes.</small>
            </div>
        </div>
    </h1><br>
    <form action="{{ route('admin.nests.new') }}" method="POST">
        <div class="glass-card rounded-lg shadow-xl">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">Nest Details</h3>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div>
                    <label for="nestName" class="block text-sm font-medium text-gray-200 mb-2">
                        Name <span class="text-red-400">*</span>
                    </label>
                    <input type="text"
                           id="nestName"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        This should be a descriptive category name that encompasses all of the eggs within the nest.
                    </p>
                </div>

                <div>
                    <label for="nestDescription" class="block text-sm font-medium text-gray-200 mb-2">
                        Description <span class="text-red-400">*</span>
                    </label>
                    <textarea id="nestDescription"
                              name="description"
                              rows="6"
                              class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ old('description') }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        A detailed description of this nest and the game servers it contains.
                    </p>
                </div>
            </div>

            <div class="p-6 bg-background-darker/50 flex justify-end space-x-3">
                {!! csrf_field() !!}
                <a href="{{ route('admin.nests') }}"
                   class="px-4 py-2 text-gray-400 hover:text-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Create Nest
                </button>
            </div>
        </div>
    </form>
@endsection
