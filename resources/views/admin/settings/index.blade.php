@extends('layouts.admin')

@section('title')
    Settings
@endsection


@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-cog text-accent-purple"></i>
        </div>
        <div>
            System Settings
            <small class="block mt-1 text-base font-normal text-gray-400">Configure and manage system-wide settings and preferences.</small>
        </div>
    </div>
</h1>
<br>
<div class="space-y-6">
    <!-- Quick Settings -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $quickSettings = [
                [
                    'title' => 'Company Branding',
                    'icon' => 'fa-building',
                    'color' => 'purple',
                    'description' => 'Configure your company name and branding settings.',
                    'setting' => config('app.name')
                ],
                [
                    'title' => 'Security Level',
                    'icon' => 'fa-shield-alt',
                    'color' => 'blue',
                    'description' => '2FA requirement level for users.',
                    'setting' => config('pterodactyl.auth.2fa_required') == 2 ? 'All Users' : (config('pterodactyl.auth.2fa_required') == 1 ? 'Admin Only' : 'Not Required')
                ],
                [
                    'title' => 'Default Language',
                    'icon' => 'fa-language',
                    'color' => 'green',
                    'description' => 'System-wide default language setting.',
                    'setting' => $languages[config('app.locale')] ?? config('app.locale')
                ]
            ];
        @endphp

        @foreach($quickSettings as $setting)
            <div class="glass-card rounded-xl p-6 border border-gray-700/50">
                <div class="flex items-start justify-between">
                    <div class="flex-grow">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-accent-{{ $setting['color'] }}/10 flex items-center justify-center">
                                <i class="fas {{ $setting['icon'] }} text-accent-{{ $setting['color'] }}"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-200">{{ $setting['title'] }}</h3>
                                <p class="text-sm text-gray-400 mt-1">{{ $setting['description'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center space-x-2">
                            <div class="px-3 py-1 rounded-lg bg-background text-sm text-gray-300">
                                {{ $setting['setting'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Settings Form -->
    <form action="{{ route('admin.settings') }}" method="POST">
        @csrf
        <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
            <div class="p-6 space-y-8">
                <!-- Company Settings -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">Company Settings</h3>
                        <span class="px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded-full">
                            Branding
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="app-name" class="block text-sm font-medium text-gray-200">Company Name</label>
                            <input type="text" id="app-name" name="app:name"
                                   value="{{ old('app:name', config('app.name')) }}"
                                   class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50" />
                            <p class="text-xs text-gray-400">The name displayed throughout the panel and in emails.</p>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="space-y-6 pt-6 border-t border-gray-700/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">Security Settings</h3>
                        <span class="px-3 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-full">
                            Authentication
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-200">2FA Requirement Level</label>
                            @php
                                $level = old('pterodactyl:auth:2fa_required', config('pterodactyl.auth.2fa_required'));
                            @endphp
                            <div class="space-y-3">
                                @foreach([
                                    ['value' => 0, 'label' => 'Not Required', 'description' => 'Two-factor authentication is optional for all users.'],
                                    ['value' => 1, 'label' => 'Admin Only', 'description' => 'Only administrators are required to enable 2FA.'],
                                    ['value' => 2, 'label' => 'All Users', 'description' => 'Every user must enable two-factor authentication.']
                                ] as $option)
                                    <label class="flex items-start p-3 rounded-lg border border-gray-700 cursor-pointer hover:bg-accent-purple/5 transition-colors">
                                        <input type="radio"
                                               name="pterodactyl:auth:2fa_required"
                                               value="{{ $option['value'] }}"
                                               {{ $level == $option['value'] ? 'checked' : '' }}
                                               class="mt-1 text-accent-purple focus:ring-accent-purple" />
                                        <div class="ml-3">
                                            <span class="block text-sm font-medium text-gray-200">{{ $option['label'] }}</span>
                                            <span class="block text-xs text-gray-400 mt-1">{{ $option['description'] }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Localization Settings -->
                <div class="space-y-6 pt-6 border-t border-gray-700/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">Localization</h3>
                        <span class="px-3 py-1 text-xs bg-accent-green/10 text-accent-green rounded-full">
                            Language
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="app-locale" class="block text-sm font-medium text-gray-200">Default Language</label>
                            <select id="app-locale" name="app:locale"
                                    class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                @foreach($languages as $key => $value)
                                    <option value="{{ $key }}" {{ config('app.locale') === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400">The default language for all users (can be changed per-user).</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-background-darker border-t border-gray-700/50 flex items-center justify-between">
                <span class="text-sm text-gray-400">
                    <i class="fas fa-info-circle mr-2"></i>
                    Changes will be applied immediately
                </span>
                <button type="submit" name="_method" value="PATCH"
                        class="px-5 py-2.5 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors inline-flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .glass-card {
        @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
    }

    .gradient-text {
        @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
    }
</style>
@endsection
