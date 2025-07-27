@extends('layouts.admin')

@section('title')
    Mounts &rarr; {{ $mount->name }}
@endsection



@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-hdd text-accent-purple"></i>
            </div>
            <div>
                Mount: {{ $mount->name }}
                <small class="block mt-1 text-base font-normal text-gray-400">Manage the mount point for {{ $mount->nodes->count() }} nodes.</small>
            </div>
        </div>
    </h1>
    <br>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Unique ID</p>
                    <code class="text-lg font-mono text-gray-100 mt-1">{{ $mount->uuid }}</code>
                </div>
                <div class="p-3 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-fingerprint text-accent-purple"></i>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Eggs</p>
                    <h3 class="text-2xl font-bold text-gray-100 mt-1">{{ $mount->eggs->count() }}</h3>
                </div>
                <div class="p-3 bg-accent-blue/10 rounded-lg">
                    <i class="fas fa-egg text-accent-blue"></i>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Nodes</p>
                    <h3 class="text-2xl font-bold text-gray-100 mt-1">{{ $mount->nodes->count() }}</h3>
                </div>
                <div class="p-3 bg-emerald-500/10 rounded-lg">
                    <i class="fas fa-server text-emerald-500"></i>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-400">Status</p>
                    <div class="flex items-center space-x-2 mt-1">
                        @if($mount->read_only)
                            <span class="px-2 py-1 bg-amber-500/10 text-amber-500 rounded-full text-sm">Read Only</span>
                        @endif
                        @if($mount->user_mountable)
                            <span class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-sm">User Mountable</span>
                        @endif
                    </div>
                </div>
                <div class="p-3 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-shield-alt text-accent-purple"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Mount Details -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Mount Details</h3>
            </div>
            <form action="{{ route('admin.mounts.view', $mount->id) }}" method="POST">
                <div class="p-6 space-y-6">
                    <div>
                        <label for="pName" class="block text-sm font-medium text-gray-200 mb-2">Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hdd text-gray-400"></i>
                            </div>
                            <input type="text"
                                   id="pName"
                                   name="name"
                                   value="{{ $mount->name }}"
                                   class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                        </div>
                    </div>

                    <div>
                        <label for="pDescription" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 text-gray-400">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <textarea id="pDescription"
                                     name="description"
                                     rows="3"
                                     class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ $mount->description }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pSource" class="block text-sm font-medium text-gray-200 mb-2">Source Path</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-folder text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="pSource"
                                       name="source"
                                       value="{{ $mount->source }}"
                                       class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            </div>
                        </div>

                        <div>
                            <label for="pTarget" class="block text-sm font-medium text-gray-200 mb-2">Target Path</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-folder-open text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="pTarget"
                                       name="target"
                                       value="{{ $mount->target }}"
                                       class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Read Only</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="read_only"
                                           value="0"
                                           @if(!$mount->read_only) checked @endif
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Writable</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="read_only"
                                           value="1"
                                           @if($mount->read_only) checked @endif
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-amber-500 peer-checked:bg-amber-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-amber-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Read Only</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">User Mountable</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="user_mountable"
                                           value="0"
                                           @if(!$mount->user_mountable) checked @endif
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-red-500 peer-checked:bg-red-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-red-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">Admin Only</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio"
                                           name="user_mountable"
                                           value="1"
                                           @if($mount->user_mountable) checked @endif
                                           class="hidden peer" />
                                    <div class="w-5 h-5 border-2 rounded flex items-center justify-center mr-2
                                                peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20
                                                border-gray-600 transition-colors">
                                        <i class="fas fa-check text-emerald-500 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                    <span class="text-gray-200">User Mountable</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-background-darker/50 flex items-center justify-between">
                    <button type="submit"
                            name="action"
                            value="delete"
                            class="group px-4 py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                        <i class="fas fa-trash-alt mr-2 group-hover:animate-bounce"></i>
                        Delete Mount
                    </button>
                    <div class="flex items-center space-x-3">
                        {!! csrf_field() !!}
                        {!! method_field('PATCH') !!}
                        <button type="submit"
                                name="action"
                                value="edit"
                                class="group px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            <i class="fas fa-save mr-2 group-hover:animate-bounce"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Eggs & Nodes -->
        <div class="space-y-6">
            <!-- Eggs List -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">Connected Eggs</h3>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($mount->eggs as $egg)
                        <div class="bg-background-darker/50 rounded-lg p-4 hover:bg-background-darker transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="p-2 bg-accent-purple/10 rounded-lg">
                                        <i class="fas fa-egg text-accent-purple"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.nests.egg.view', $egg->id) }}"
                                           class="text-gray-100 hover:text-accent-purple transition-colors font-medium">
                                            {{ $egg->name }}
                                        </a>
                                        <div class="mt-1">
                                            <code class="px-2 py-0.5 bg-background rounded text-xs text-gray-400">
                                                ID: {{ $egg->id }}
                                            </code>
                                        </div>
                                    </div>
                                </div>
                                <button data-action="detach-egg"
                                        data-id="{{ $egg->id }}"
                                        class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <div class="bg-accent-purple/10 rounded-full p-3 w-12 h-12 flex items-center justify-center mx-auto">
                                <i class="fas fa-egg text-accent-purple"></i>
                            </div>
                            <h3 class="mt-4 text-gray-200 font-medium">No Eggs Connected</h3>
                            <p class="mt-1 text-sm text-gray-400">Add eggs to use this mount point.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Nodes List -->
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                    <h3 class="text-xl font-semibold gradient-text">Connected Nodes</h3>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($mount->nodes as $node)
                        <div class="bg-background-darker/50 rounded-lg p-4 hover:bg-background-darker transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="p-2 bg-emerald-500/10 rounded-lg">
                                        <i class="fas fa-server text-emerald-500"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.nodes.view', $node->id) }}"
                                           class="text-gray-100 hover:text-accent-purple transition-colors font-medium">
                                            {{ $node->name }}
                                        </a>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <code class="px-2 py-0.5 bg-background rounded text-xs text-gray-400">
                                                ID: {{ $node->id }}
                                            </code>
                                            <code class="px-2 py-0.5 bg-background rounded text-xs text-gray-400">
                                                {{ $node->fqdn }}
                                            </code>
                                        </div>
                                    </div>
                                </div>
                                <button data-action="detach-node"
                                        data-id="{{ $node->id }}"
                                        class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <div class="bg-emerald-500/10 rounded-full p-3 w-12 h-12 flex items-center justify-center mx-auto">
                                <i class="fas fa-server text-emerald-500"></i>
                            </div>
                            <h3 class="mt-4 text-gray-200 font-medium">No Nodes Connected</h3>
                            <p class="mt-1 text-sm text-gray-400">Add nodes to use this mount point.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .group:hover .group-hover\:animate-bounce {
            animation: bounce 0.5s infinite;
        }

        /* Select2 Dark Theme */
        .select2-container--dark {
            @apply w-full;
        }

        .select2-container--dark .select2-selection--multiple {
            @apply bg-background border-gray-700 rounded-lg;
        }

        .select2-container--dark .select2-selection--multiple .select2-selection__choice {
            @apply bg-accent-purple/20 text-accent-purple border-accent-purple/30 rounded px-2 py-0.5;
        }

        .select2-container--dark .select2-dropdown {
            @apply bg-background border-gray-700 rounded-lg mt-1;
        }

        .select2-container--dark .select2-results__option {
            @apply text-gray-200 px-3 py-2;
        }

        .select2-container--dark .select2-results__option--highlighted {
            @apply bg-accent-purple/20;
        }

        .select2-container--dark .select2-search__field {
            @apply bg-background text-gray-200 border-gray-700 rounded;
        }

        .select2-container--dark .select2-results__group {
            @apply text-gray-400 text-sm font-medium px-3 py-1;
        }
    </style>

    @section('footer-scripts')
        @parent
        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#pEggs').select2({
                    theme: 'dark',
                    placeholder: 'Select eggs to add...',
                    width: '100%'
                });

                $('#pNodes').select2({
                    theme: 'dark',
                    placeholder: 'Select nodes to add...',
                    width: '100%'
                });

                // Handle Detach Actions
                $('button[data-action="detach-egg"]').click(function(event) {
                    event.preventDefault();
                    const element = $(this);
                    const eggId = $(this).data('id');

                    $.ajax({
                        method: 'DELETE',
                        url: '/admin/mounts/' + {{ $mount->id }} + '/eggs/' + eggId,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    }).done(function() {
                        element.closest('.bg-background-darker\\/50').fadeOut(200);
                        // Show success toast
                    }).fail(function(jqXHR) {
                        console.error(jqXHR);
                        // Show error toast
                    });
                });

                $('button[data-action="detach-node"]').click(function(event) {
                    event.preventDefault();
                    const element = $(this);
                    const nodeId = $(this).data('id');

                    $.ajax({
                        method: 'DELETE',
                        url: '/admin/mounts/' + {{ $mount->id }} + '/nodes/' + nodeId,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    }).done(function() {
                        element.closest('.bg-background-darker\\/50').fadeOut(200);
                        // Show success toast
                    }).fail(function(jqXHR) {
                        console.error(jqXHR);
                        // Show error toast
                    });
                });
            });

            function toggleModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    setTimeout(() => modal.querySelector('[x-data]').__x.$data.show = true, 50);
                } else {
                    modal.querySelector('[x-data]').__x.$data.show = false;
                    setTimeout(() => modal.classList.add('hidden'), 200);
                }
            }
        </script>
    @endsection
@endsection
