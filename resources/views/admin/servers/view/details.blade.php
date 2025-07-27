@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}: Details
@endsection

@section('content')


@include('admin.servers.partials.navigation')


<form action="{{ route('admin.servers.view.details', $server->id) }}" method="POST">
    <div class="glass-card rounded-lg overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-200 mb-2">
                        Server Name <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-server text-gray-400"></i>
                        </div>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $server->name) }}"
                               class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Character limits: <code class="px-1.5 py-0.5 bg-background-darker rounded">a-zA-Z0-9_-</code> and <code class="px-1.5 py-0.5 bg-background-darker rounded">[Space]</code>
                    </p>
                </div>

                <div>
                    <label for="external_id" class="block text-sm font-medium text-gray-200 mb-2">
                        External Identifier
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-fingerprint text-gray-400"></i>
                        </div>
                        <input type="text"
                               id="external_id"
                               name="external_id"
                               value="{{ old('external_id', $server->external_id) }}"
                               class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Leave empty to not assign an external identifier. Must be unique across all servers.
                    </p>
                </div>

                <div x-data="ownerSelect()" class="relative">
                    <label class="block text-sm font-medium text-gray-200 mb-2">
                        Server Owner <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="hidden" name="owner_id" x-model="selectedId">
                        <button type="button"
                                @click="isOpen = !isOpen"
                                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 flex items-center justify-between">
                            <div class="flex items-center space-x-3" x-show="!loading">
                                <template x-if="selectedUser">
                                    <img :src="'https://www.gravatar.com/avatar/' + selectedUser.md5 + '?s=120'"
                                         class="h-8 w-8 rounded-full"
                                         alt="User Avatar">
                                </template>
                                <div class="text-left">
                                    <div x-text="selectedUser ? selectedUser.name_first + ' ' + selectedUser.name_last : 'Select Owner'"
                                         class="text-gray-200"></div>
                                    <div x-text="selectedUser ? selectedUser.email : ''"
                                         class="text-sm text-gray-400"></div>
                                </div>
                            </div>
                            <div x-show="loading" class="flex items-center space-x-2">
                                <i class="fas fa-circle-notch fa-spin text-gray-400"></i>
                                <span class="text-gray-400">Loading...</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 ml-2"
                               :class="{ 'transform rotate-180': isOpen }"></i>
                        </button>

                        <div x-show="isOpen"
                             @click.away="isOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute z-50 w-full mt-1 bg-background-darker border border-gray-700 rounded-lg shadow-lg">
                            <div class="p-2">
                                <input type="text"
                                       x-model="search"
                                       @input.debounce.300ms="searchUsers"
                                       placeholder="Search by email..."
                                       class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            </div>
                            <div class="max-h-60 overflow-y-auto">
                                <template x-for="user in users" :key="user.id">
                                    <button type="button"
                                            @click="selectUser(user)"
                                            class="w-full px-4 py-2 flex items-center space-x-3 hover:bg-accent-purple/10 transition-colors">
                                        <img :src="'https://www.gravatar.com/avatar/' + user.md5 + '?s=120'"
                                             class="h-8 w-8 rounded-full"
                                             alt="User Avatar">
                                        <div class="text-left">
                                            <div x-text="user.name_first + ' ' + user.name_last"
                                                 class="text-gray-200"></div>
                                            <div x-text="user.email"
                                                 class="text-sm text-gray-400"></div>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Changing the owner will generate a new daemon security token automatically.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-200 mb-2">
                        Description
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <textarea id="description"
                                 name="description"
                                 rows="3"
                                 class="w-full pl-10 px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">{{ old('description', $server->description) }}</textarea>
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        A brief description of this server.
                    </p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-background-darker/50 flex justify-end space-x-3">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}
            <button type="submit"
                    class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-save mr-2"></i>
                Update Details
            </button>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function ownerSelect() {
            return {
                isOpen: false,
                loading: false,
                search: '',
                users: [],
                selectedId: '{{ $server->owner_id }}',
                selectedUser: {
                    id: {{ $server->owner_id }},
                    md5: '{{ md5(strtolower($server->user->email)) }}',
                    name_first: '{{ $server->user->name_first }}',
                    name_last: '{{ $server->user->name_last }}',
                    email: '{{ $server->user->email }}'
                },
                async searchUsers() {
                    if (this.search.length < 2) return;

                    this.loading = true;
                    try {
                        const response = await fetch(`/admin/users/accounts.json?filter[email]=${this.search}`);
                        const data = await response.json();
                        this.users = data;
                    } catch (error) {
                        console.error('Error fetching users:', error);
                    }
                    this.loading = false;
                },
                selectUser(user) {
                    this.selectedUser = user;
                    this.selectedId = user.id;
                    this.isOpen = false;
                }
            }
        }
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }
    </style>
@endsection
