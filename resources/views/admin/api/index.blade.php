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
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-100">Credentials List</h2>
        <a href="{{ route('admin.api.new') }}"
           class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
            <i class="fas fa-plus-circle mr-2"></i>Create New
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @foreach($keys as $key)
            <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10 border border-gray-700/50">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-grow">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-accent-purple/10 flex items-center justify-center">
                                    <i class="fas fa-key text-accent-purple"></i>
                                </div>
                                <div>
                                    <span class="text-gray-200 font-medium">{{ $key->memo }}</span>
                                    <div class="text-sm text-gray-400">
                                        <i class="fas fa-calendar mr-2"></i>Created @datetimeHuman($key->created_at)
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 group">
                                <div class="relative flex-grow max-w-2xl">
                                    <div class="bg-background-darker bg-opacity-50 rounded-lg p-3 relative">
                                        <code class="text-sm text-gray-200 blur-sm group-hover:blur-none transition-all duration-300 block">
                                            {{ $key->identifier }}{{ decrypt($key->token) }}
                                        </code>
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-400 group-hover:opacity-0 transition-opacity duration-300">
                                            <i class="fas fa-eye text-sm mr-2"></i>
                                            <span class="text-sm">Hover to reveal API key</span>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="copyToClipboard('{{ $key->identifier }}{{ decrypt($key->token) }}')"
                                        class="p-3 text-gray-400 hover:text-accent-purple transition-colors opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-background-darker bg-opacity-50 rounded-lg"
                                        title="Copy API Key">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col items-end space-y-4">
                            <button data-action="revoke-key"
                                    data-attr="{{ $key->identifier }}"
                                    class="inline-flex items-center px-4 py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                                <i class="fas fa-trash-alt text-sm mr-2"></i>
                                <span class="text-sm font-medium">Revoke Key</span>
                            </button>

                            <div class="flex items-center text-gray-400 text-sm">
                                <i class="fas fa-clock mr-2"></i>
                                <span>
                                    @if(!is_null($key->last_used_at))
                                        Last used @datetimeHuman($key->last_used_at)
                                    @else
                                        Never used
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($keys->isEmpty())
        <div class="glass-card rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10 border border-gray-700/50">
            <div class="p-6">
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-400">No API keys found. Create a new one to get started.</p>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('footer-scripts')
    @parent
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 px-6 py-3 bg-green-500 text-white rounded-lg shadow-lg transform transition-all duration-300 translate-y-full opacity-0 flex items-center';
                toast.innerHTML = '<i class="fas fa-check-circle mr-2"></i>API Key copied to clipboard';
                document.body.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.remove('translate-y-full', 'opacity-0');
                });

                setTimeout(() => {
                    toast.classList.add('translate-y-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 300);
                }, 2000);
            });
        }

        $(document).ready(function() {
            $('[data-action="revoke-key"]').click(function (event) {
                var self = $(this);
                event.preventDefault();

                Swal.fire({
                    title: 'Revoke API Key',
                    text: 'Once this API key is revoked any applications currently using it will stop working.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Revoke',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            method: 'DELETE',
                            url: '/admin/api/revoke/' + self.data('attr'),
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).catch(error => {
                            Swal.showValidationMessage(
                                'Request failed: An error occurred while attempting to revoke this key.'
                            )
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'API Key has been revoked.',
                            icon: 'success'
                        });
                        self.closest('.glass-card').slideUp();
                    }
                });
            });
        });
    </script>

    <style>
        .glass-card {
            @apply bg-background-darker bg-opacity-50 backdrop-blur-sm;
        }

        /* SweetAlert Dark Theme Overrides */
        .swal2-popup {
            background: rgb(17, 24, 39) !important;
            color: white !important;
        }

        .swal2-title {
            color: white !important;
        }

        .swal2-html-container {
            color: rgb(156, 163, 175) !important;
        }

        .swal2-icon.swal2-warning {
            border-color: rgb(234, 179, 8) !important;
            color: rgb(234, 179, 8) !important;
        }

        .swal2-icon.swal2-success {
            border-color: rgb(34, 197, 94) !important;
            color: rgb(34, 197, 94) !important;
        }

        .swal2-success-circular-line-left,
        .swal2-success-circular-line-right,
        .swal2-success-fix {
            background: rgb(17, 24, 39) !important;
        }
    </style>
@endsection
