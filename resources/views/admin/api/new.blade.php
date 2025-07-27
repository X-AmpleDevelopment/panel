@extends('layouts.admin')

@section('title')
    Application API
@endsection


@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-key text-accent-purple"></i>
        </div>
        <div>
            Application API
            <small class="block mt-1 text-base font-normal text-gray-400">Create and manage API credentials for external applications.</small>
        </div>
    </div>
</h1>
<br>
<form method="POST" action="{{ route('admin.api.new') }}">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">Select Permissions</h3>
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="setAllPermissions('{{ $permissions['r'] }}')"
                                    class="px-3 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-lg hover:bg-accent-blue/20 transition-colors">
                                All Read
                            </button>
                            <button type="button" onclick="setAllPermissions('{{ $permissions['rw'] }}')"
                                    class="px-3 py-1 text-xs bg-green-500/10 text-green-500 rounded-lg hover:bg-green-500/20 transition-colors">
                                All Read & Write
                            </button>
                            <button type="button" onclick="setAllPermissions('{{ $permissions['n'] }}')"
                                    class="px-3 py-1 text-xs bg-gray-500/10 text-gray-400 rounded-lg hover:bg-gray-500/20 transition-colors">
                                All None
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($resources as $resource)
                            <div class="flex items-center p-4 rounded-lg bg-background-darker/50 hover:bg-background-darker transition-colors">
                                <div class="w-1/3">
                                    <span class="text-gray-200 font-medium">{{ str_replace('_', ' ', title_case($resource)) }}</span>
                                </div>
                                <div class="w-2/3 flex space-x-4">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio"
                                               id="r_{{ $resource }}"
                                               name="r_{{ $resource }}"
                                               value="{{ $permissions['r'] }}"
                                               class="form-radio text-accent-blue focus:ring-accent-blue">
                                        <span class="text-sm text-gray-200">Read</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio"
                                               id="rw_{{ $resource }}"
                                               name="r_{{ $resource }}"
                                               value="{{ $permissions['rw'] }}"
                                               class="form-radio text-green-500 focus:ring-green-500">
                                        <span class="text-sm text-gray-200">Read & Write</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio"
                                               id="n_{{ $resource }}"
                                               name="r_{{ $resource }}"
                                               value="{{ $permissions['n'] }}"
                                               checked
                                               class="form-radio text-gray-500 focus:ring-gray-500">
                                        <span class="text-sm text-gray-200">None</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Templates -->
            <div class="glass-card rounded-lg p-6">
                <h3 class="text-xl font-semibold gradient-text mb-4">Quick Templates</h3>
                <div class="space-y-3">
                    <button type="button" onclick="applyTemplate('whmcs')"
                            class="w-full px-4 py-3 flex items-center justify-between bg-background-darker rounded-lg hover:bg-background-darker/70 transition-colors">
                        <span class="text-gray-200">WHMCS Integration</span>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    <button type="button" onclick="applyTemplate('monitoring')"
                            class="w-full px-4 py-3 flex items-center justify-between bg-background-darker rounded-lg hover:bg-background-darker/70 transition-colors">
                        <span class="text-gray-200">Monitoring System</span>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    <button type="button" onclick="applyTemplate('mythicaldash')"
                            class="w-full px-4 py-3 flex items-center justify-between bg-background-darker rounded-lg hover:bg-background-darker/70 transition-colors">
                        <span class="text-gray-200">MythicalDash</span>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                </div>
            </div>

            <!-- Description -->
            <div class="glass-card rounded-lg p-6">
                <h3 class="text-xl font-semibold gradient-text mb-4">Details</h3>
                <div class="space-y-4">
                    <div>
                        <label for="memoField" class="block text-sm font-medium text-gray-200">Description <span class="text-red-500">*</span></label>
                        <input type="text"
                               id="memoField"
                               name="memo"
                               class="mt-1 w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                    </div>
                    <p class="text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Once created, these credentials cannot be edited. You'll need to create new ones if changes are needed.
                    </p>
                </div>
            </div>

            <div class="flex justify-end">
                {{ csrf_field() }}
                <button type="submit" class="px-6 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                    <i class="fas fa-key mr-2"></i>
                    Create Credentials
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        function setAllPermissions(value) {
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                if (radio.value === value) {
                    radio.checked = true;
                }
            });
        }

        function applyTemplate(type) {
            const templates = {
                whmcs: {
                    memo: 'WHMCS Integration',
                    permissions: {
                        users: 'rw',
                        servers: 'rw',
                        nodes: 'r',
                        allocations: 'r',
                        locations: 'r'
                    }
                },
                monitoring: {
                    memo: 'Monitoring System',
                    permissions: {
                        users: 'r',
                        servers: 'r',
                        nodes: 'r',
                        allocations: 'r',
                        locations: 'r'
                    }
                },
                mythicaldash: {
                    memo: 'MythicalDash',
                    permissions: {
                        servers: 'rw',
                        users: 'rw',
                        nodes: 'rw',
                        allocations: 'rw',
                        locations: 'r',
                    }
                }
            };

            const template = templates[type];
            if (!template) return;

            // Set memo
            document.getElementById('memoField').value = template.memo;

            // Reset all to none first
            setAllPermissions('{{ $permissions['n'] }}');

            // Set specific permissions
            Object.entries(template.permissions).forEach(([resource, permission]) => {
                const value = permission === 'rw' ? '{{ $permissions['rw'] }}' : '{{ $permissions['r'] }}';
                document.querySelector(`input[name="r_${resource}"][value="${value}"]`).checked = true;
            });
        }
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-accent-purple to-accent-blue;
        }

        /* Custom Radio Styles */
        .form-radio {
            @apply h-4 w-4 border-gray-700 focus:ring-offset-background;
        }
    </style>
@endsection
