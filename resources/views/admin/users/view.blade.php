@extends('layouts.admin')

@section('title')
    Manage User: {{ $user->username }}
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-user text-accent-purple"></i>
            </div>
            <div>
                User: {{ $user->username }}
                <small class="block mt-1 text-base font-normal text-gray-400">Manage user account details and permissions.</small>
            </div>
        </div>
    </h1>
    <br>
    <div class="mb-6">
        <!-- User Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="glass-card rounded-lg p-6 flex items-center space-x-4">
                <div class="p-3 rounded-full bg-accent-blue/10 text-accent-blue">
                    <i class="fas fa-server text-2xl"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Servers Owned</div>
                    <div class="text-2xl font-bold text-gray-200">{{ $user->servers->count() }}</div>
                </div>
            </div>

            <div class="glass-card rounded-lg p-6 flex items-center space-x-4">
                <div class="p-3 rounded-full bg-green-500/10 text-green-500">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Member Since</div>
                    <div class="text-2xl font-bold text-gray-200">{{ $user->created_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="glass-card rounded-lg p-6 flex items-center space-x-4">
                <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-500">
                    <i class="fas fa-sign-in-alt text-2xl"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Last Login</div>
                    <div class="text-2xl font-bold text-gray-200">{{ $user->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="glass-card rounded-lg p-6 flex items-center space-x-4">
                <div class="p-3 rounded-full {{ $user->root_admin ? 'bg-purple-500/10 text-purple-500' : 'bg-gray-500/10 text-gray-500' }}">
                    <i class="fas fa-user-shield text-2xl"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-400">Account Type</div>
                    <div class="text-2xl font-bold text-gray-200">{{ $user->root_admin ? 'Admin' : 'User' }}</div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.users.view', $user->id) }}" method="post">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Identity -->
                <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold gradient-text">Identity</h3>
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->email)) }}?s=200"
                             class="h-12 w-12 rounded-full ring-2 ring-gray-700"
                             alt="{{ $user->name_first }} {{ $user->name_last }}">
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                            <div class="mt-1 relative">
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ $user->email }}"
                                       class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <a href="mailto:{{ $user->email }}"
                                   class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent-purple">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ $user->username }}"
                                   class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="name_first" class="block text-sm font-medium text-gray-200">First Name</label>
                                <input type="text"
                                       id="name_first"
                                       name="name_first"
                                       value="{{ $user->name_first }}"
                                       class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="name_last" class="block text-sm font-medium text-gray-200">Last Name</label>
                                <input type="text"
                                       id="name_last"
                                       name="name_last"
                                       value="{{ $user->name_last }}"
                                       class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            </div>
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-200">Default Language</label>
                            <select name="language"
                                    id="language"
                                    class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                @foreach($languages as $key => $value)
                                    <option value="{{ $key }}" @if($user->language === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-400">The default language to use when rendering the Panel for this user.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Permissions -->
                    <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                        <h3 class="text-xl font-semibold mb-6 gradient-text">Permissions</h3>
                        <div>
                            <label for="root_admin" class="block text-sm font-medium text-gray-200">Administrator Role</label>
                            <select name="root_admin"
                                    id="root_admin"
                                    class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <option value="0" @if(!$user->root_admin) selected @endif>@lang('strings.no')</option>
                                <option value="1" @if($user->root_admin) selected @endif>@lang('strings.yes')</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-400">Setting this to 'Yes' gives a user full administrative access.</p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                        <h3 class="text-xl font-semibold mb-6 gradient-text">Password</h3>
                        <div id="gen_pass" class="mb-6 p-4 bg-green-500/10 text-green-500 rounded-lg hidden"></div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-200">New Password</label>
                            <div class="mt-1 relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <button type="button"
                                        id="gen_pass_bttn"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded hover:bg-accent-purple/20 transition-colors">
                                    Generate
                                </button>
                            </div>
                            <p class="mt-2 text-xs text-gray-400">Leave blank to keep the user's current password. User will not receive any notification if password is changed.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}

                <div class="flex items-center space-x-3">
                    <button type="button"
                            @if($user->servers->count() > 0) disabled @endif
                            onclick="confirmDelete()"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Delete User
                    </button>
                    @if($user->servers->count() > 0)
                        <span class="text-sm text-gray-400">Cannot delete user with active servers</span>
                    @endif
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.users') }}"
                       class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                        Update User
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete User Form -->
        <form id="deleteForm" action="{{ route('admin.users.view', $user->id) }}" method="POST" class="hidden">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
        </form>

        <!-- Activity Log -->
        @if($user->root_admin)
            <div class="mt-6">
                <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold gradient-text">Administrative Activity Log</h3>
                        <div class="flex items-center space-x-4">
                            <input type="text"
                                id="searchActivity"
                                placeholder="Search activities..."
                                class="px-3 py-1 text-sm bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            <select id="limitActivity"
                                class="px-3 py-1 text-sm bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <option value="50">50 entries</option>
                                <option value="100">100 entries</option>
                                <option value="250">250 entries</option>
                                <option value="500">500 entries</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-background-darker bg-opacity-50">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Time</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Event</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">IP Address</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700/50">
                                @forelse($activities as $activity)
                                    <tr class="activity-row hover:bg-background-darker/50 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock text-gray-400 mr-2"></i>
                                                <span class="text-sm text-gray-200" title="{{ $activity->date }}">
                                                    {{ $activity->date->diffForHumans() }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                @php
                                                    $eventColors = [
                                                        'admin.users.create' => 'text-green-500 bg-green-500/10',
                                                        'admin.users.update' => 'text-blue-500 bg-blue-500/10',
                                                        'admin.users.delete' => 'text-red-500 bg-red-500/10',
                                                        'admin.users.view' => 'text-yellow-500 bg-yellow-500/10',
                                                        'default' => 'text-gray-500 bg-gray-500/10'
                                                    ];
                                                    $eventColor = $eventColors[$activity->event] ?? $eventColors['default'];
                                                @endphp
                                                <span class="px-2 py-1 text-xs rounded-full {{ $eventColor }}">
                                                    {{ str_replace('admin.', '', $activity->event) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <code class="text-xs bg-background-darker bg-opacity-50 px-2 py-1 rounded text-gray-200">
                                                {{ $activity->ip }}
                                            </code>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-gray-200">
                                                {{ $activity->description }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-history text-4xl mb-2"></i>
                                                <p>No administrative activities recorded yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }

        $("#gen_pass_bttn").click(function (event) {
            event.preventDefault();
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }

            $("#gen_pass").html('<strong>Generated Password:</strong> ' + password).slideDown();
            $('input[name="password"]').val(password);
        });

        // Activity Log Search and Limit
        $('#searchActivity').on('keyup', function() {
            const searchText = $(this).val().toLowerCase();
            $('.activity-row').each(function() {
                const rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.includes(searchText));
            });
        });

        $('#limitActivity').on('change', function() {
            window.location.href = '{{ route('admin.users.view', $user->id) }}?limit=' + $(this).val();
        });

        // Set initial limit value
        $('#limitActivity').val('{{ request()->get('limit', 50) }}');
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
