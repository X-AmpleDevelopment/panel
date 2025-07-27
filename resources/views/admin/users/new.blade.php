@extends('layouts.admin')

@section('title')
    Create User
@endsection

@section('content-header')

    <ol class="flex mt-2 text-sm text-gray-400">
        <li><a href="{{ route('admin.index') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Admin</a></li>
        <li class="mx-2">/</li>
        <li><a href="{{ route('admin.users') }}" class="text-accent-blue hover:text-accent-purple transition-colors">Users</a></li>
        <li class="mx-2">/</li>
        <li class="text-gray-200">Create</li>
    </ol>
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-user-plus text-accent-purple"></i>
            </div>
            <div>
                Create User
                <small class="block mt-1 text-base font-normal text-gray-400">Create a new user account.</small>
            </div>
        </div>
    </h1><br>
    <form method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Identity -->
            <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                <h3 class="text-xl font-semibold mb-6 gradient-text">Identity</h3>
                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                               autocomplete="off" />
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                        <input type="text"
                               id="username"
                               name="username"
                               value="{{ old('username') }}"
                               class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                               autocomplete="off" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name_first" class="block text-sm font-medium text-gray-200">First Name</label>
                            <input type="text"
                                   id="name_first"
                                   name="name_first"
                                   value="{{ old('name_first') }}"
                                   class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                   autocomplete="off" />
                        </div>

                        <div>
                            <label for="name_last" class="block text-sm font-medium text-gray-200">Last Name</label>
                            <input type="text"
                                   id="name_last"
                                   name="name_last"
                                   value="{{ old('name_last') }}"
                                   class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                   autocomplete="off" />
                        </div>
                    </div>

                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-200">Default Language</label>
                        <select name="language"
                                id="language"
                                class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            @foreach($languages as $key => $value)
                                <option value="{{ $key }}" @if(config('app.locale') === $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-400">The default language to use when rendering the Panel for this user.</p>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="space-y-6">
                <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                    <h3 class="text-xl font-semibold mb-6 gradient-text">Permissions</h3>
                    <div>
                        <label for="root_admin" class="block text-sm font-medium text-gray-200">Administrator Role</label>
                        <select name="root_admin"
                                id="root_admin"
                                class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                            <option value="0">@lang('strings.no')</option>
                            <option value="1">@lang('strings.yes')</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-400">Setting this to 'Yes' gives a user full administrative access.</p>
                    </div>
                </div>

                <!-- Password -->
                <div class="glass-card rounded-lg p-6 transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10">
                    <h3 class="text-xl font-semibold mb-6 gradient-text">Password</h3>

                    <div class="mb-6 p-4 bg-accent-blue/10 text-accent-blue rounded-lg">
                        <p class="text-sm">Providing a user password is optional. New user emails prompt users to create a password the first time they login. If a password is provided here you will need to find a different method of providing it to the user.</p>
                    </div>

                    <div id="gen_pass" class="mb-6 p-4 bg-green-500/10 text-green-500 rounded-lg hidden"></div>

                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                            <div class="mt-1 relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                                <button type="button"
                                        id="gen_pass_bttn"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded hover:bg-accent-purple/20 transition-colors">
                                    Generate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            {!! csrf_field() !!}
            <a href="{{ route('admin.users') }}" class="px-6 py-2 mr-3 text-gray-400 hover:text-gray-200 transition-colors">
                Cancel
            </a>

            <button type="submit" class="px-6 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                Create User
            </button>
        </div>
    </form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $("#gen_pass_bttn").click(function (event) {
            event.preventDefault();

            // Generate random password
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }

            // Display and set the generated password
            $("#gen_pass").html('<strong>Generated Password:</strong> ' + password).slideDown();
            $('input[name="password"]').val(password);
        });
    </script>

    <style>
        /* Additional custom styles */
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }
    </style>
@endsection
