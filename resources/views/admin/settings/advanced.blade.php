@extends('layouts.admin')

@section('title')
    Advanced Settings
@endsection


@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-cog text-accent-purple"></i>
        </div>
        <div>
            Advanced Settings
            <small class="block mt-1 text-base font-normal text-gray-400">Configure advanced system settings and technical preferences.</small>
        </div>
    </div>
</h1>
<br>
    <form action="" method="POST">
        <div class="grid grid-cols-12 gap-6">
            <!-- Quick Overview -->
            <div class="col-span-12">
                <div class="glass-card rounded-2xl p-4 border border-gray-700/50">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-background/30 rounded-xl border border-gray-700/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-accent-blue/10 flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-xl text-accent-blue"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-200">reCAPTCHA Status</h3>
                                    <p class="text-2xl font-bold gradient-text mt-1">
                                        {{ config('recaptcha.enabled') ? 'Enabled' : 'Disabled' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-background/30 rounded-xl border border-gray-700/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                    <i class="fas fa-clock text-xl text-accent-purple"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-200">Connection Timeout</h3>
                                    <p class="text-2xl font-bold gradient-text mt-1">
                                        {{ config('pterodactyl.guzzle.connect_timeout') }}s
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-background/30 rounded-xl border border-gray-700/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-accent-green/10 flex items-center justify-center">
                                    <i class="fas fa-network-wired text-xl text-accent-green"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-200">Auto Allocation</h3>
                                    <p class="text-2xl font-bold gradient-text mt-1">
                                        {{ config('pterodactyl.client_features.allocations.enabled') ? 'Enabled' : 'Disabled' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Settings Column -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- reCAPTCHA Settings -->
                <div class="glass-card rounded-2xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-accent-blue/10 flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-accent-blue"></i>
                                </div>
                                <h3 class="text-xl font-semibold gradient-text">reCAPTCHA Configuration</h3>
                            </div>
                            <span class="px-3 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-full">Security</span>
                        </div>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="recaptcha-status" class="block text-sm font-medium text-gray-200">Status</label>
                                    <select id="recaptcha-status" name="recaptcha:enabled"
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                        <option value="true">Enabled</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Disabled</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label for="recaptcha-site-key" class="block text-sm font-medium text-gray-200">Site Key</label>
                                    <input type="text" id="recaptcha-site-key" name="recaptcha:website_key"
                                        value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}" required
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="recaptcha-secret-key" class="block text-sm font-medium text-gray-200">Secret Key</label>
                                <input type="text" id="recaptcha-secret-key" name="recaptcha:secret_key"
                                    value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}" required
                                    class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">Used for communication between your site and Google. Be sure to keep it a secret.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HTTP Connections Settings -->
                <div class="glass-card rounded-2xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                    <i class="fas fa-clock text-accent-purple"></i>
                                </div>
                                <h3 class="text-xl font-semibold gradient-text">HTTP Connections</h3>
                            </div>
                            <span class="px-3 py-1 text-xs bg-accent-purple/10 text-accent-purple rounded-full">Timeouts</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="connection-timeout" class="block text-sm font-medium text-gray-200">Connection Timeout</label>
                                <div class="relative">
                                    <input type="number" id="connection-timeout" name="pterodactyl:guzzle:connect_timeout"
                                        value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}" required
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-400">seconds</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="request-timeout" class="block text-sm font-medium text-gray-200">Request Timeout</label>
                                <div class="relative">
                                    <input type="number" id="request-timeout" name="pterodactyl:guzzle:timeout"
                                        value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}" required
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-400">seconds</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Column -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Automatic Allocation Creation -->
                <div class="glass-card rounded-2xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-accent-green/10 flex items-center justify-center">
                                <i class="fas fa-network-wired text-accent-green"></i>
                            </div>
                            <h3 class="text-xl font-semibold gradient-text">Auto Allocation</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="allocation-status" class="block text-sm font-medium text-gray-200">Status</label>
                                <select id="allocation-status" name="pterodactyl:client_features:allocations:enabled"
                                    class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    <option value="false">Disabled</option>
                                    <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>Enabled</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-200">Port Range</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <input type="number" id="allocation-start" name="pterodactyl:client_features:allocations:range_start"
                                        placeholder="Start" value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}"
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    <input type="number" id="allocation-end" name="pterodactyl:client_features:allocations:range_end"
                                        placeholder="End" value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}"
                                        class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Changes Card -->
                <div class="glass-card rounded-2xl overflow-hidden border border-gray-700/50">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                <i class="fas fa-save text-accent-purple"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-200">Save Changes</h3>
                                <p class="text-sm text-gray-400">Apply configuration updates</p>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH"
                            class="w-full px-5 py-2.5 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if($showRecaptchaWarning)
        <div class="fixed bottom-0 right-0 m-6">
            <div class="bg-yellow-400/10 border border-yellow-400/20 rounded-xl p-4 max-w-lg shadow-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-300">
                            You are currently using default reCAPTCHA keys. For improved security, please
                            <a href="https://www.google.com/recaptcha/admin" class="font-medium underline text-yellow-400 hover:text-yellow-300">generate new invisible reCAPTCHA keys</a>
                            specific to your website.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }
    </style>
@endsection

