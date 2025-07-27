@extends('layouts.admin')

@section('title')
{{ $node->name }}: Configuration
@endsection

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-100">
                <div class="flex items-center space-x-4">
                    <div class="p-2 bg-accent-purple/10 rounded-lg">
                        <i class="fas fa-server text-accent-purple"></i>
                    </div>
                    <div>
                        {{ $node->name }}
                        <small class="block mt-1 text-base font-normal text-gray-400">Daemon Configuration &
                            Deployment</small>
                    </div>
                </div>
            </h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.nodes') }}"
                class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Back to Nodes
            </a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center space-x-2 mt-8 border-b border-gray-700">
        <a href="{{ route('admin.nodes.view', $node->id) }}"
            class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
            Overview
        </a>
        <a href="{{ route('admin.nodes.view.settings', $node->id) }}"
            class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
            Settings
        </a>
        <a href="{{ route('admin.nodes.view.configuration', $node->id) }}"
            class="px-5 py-2.5 text-sm font-medium rounded-t-lg bg-accent-purple text-white border-b-2 border-accent-purple">
            Configuration
        </a>
        <a href="{{ route('admin.nodes.view.allocation', $node->id) }}"
            class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
            Allocation
        </a>
        <a href="{{ route('admin.nodes.view.servers', $node->id) }}"
            class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
            Servers
        </a>
    </div>
</div>

<div class="grid grid-cols-3 gap-8">
    <!-- Configuration File -->
    <div class="col-span-2">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Configuration File</h3>
            </div>
            <div class="p-5">
                <div class="bg-background/50 rounded-lg">
                    <pre class="p-4 text-sm text-gray-200 overflow-x-auto">{{ $node->getYamlConfiguration() }}</pre>
                </div>
                <div class="mt-4 flex items-start space-x-3 text-gray-400">
                    <i class="fas fa-info-circle mt-0.5"></i>
                    <p class="text-sm">
                        This file should be placed in your daemon's root directory (usually <code
                            class="px-1.5 py-0.5 bg-background rounded text-accent-blue">{{ '/etc/pterodactyl' }}</code>)
                        in a file called <code
                            class="px-1.5 py-0.5 bg-background rounded text-accent-blue">config.yml</code>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto Deploy -->
    <div>
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Auto-Deploy</h3>
            </div>
            <div class="p-5">
                <div class="bg-background/50 rounded-lg p-4 mb-4">
                    <p class="text-sm text-gray-400">
                        <i class="fas fa-info-circle mr-2"></i>
                        Use the button below to generate a custom deployment command that can be used to configure wings
                        on the target server with a single command.
                    </p>
                </div>
                <button type="button" id="configTokenBtn"
                    class="w-full px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors flex items-center justify-center space-x-2">
                    <i class="fas fa-terminal"></i>
                    <span>Generate Token</span>
                </button>
            </div>
        </div>

        <!-- Quick Tips -->
        <div class="glass-card rounded-lg overflow-hidden mt-8">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Quick Tips</h3>
            </div>
            <div class="p-5">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-check text-accent-purple"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-200">Verify Configuration</h4>
                            <p class="text-xs text-gray-400 mt-1">Always verify the configuration file syntax before
                                deploying.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-shield-alt text-accent-purple"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-200">Secure Your Token</h4>
                            <p class="text-xs text-gray-400 mt-1">Keep your deployment token secure and never share it
                                publicly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
@parent
<script>
    $('#configTokenBtn').on('click', function (event) {
        $.ajax({
            method: 'POST',
            url: '{{ route('admin.nodes.view.configuration.token', $node->id) }}',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        }).done(function (data) {
            const command = `cd /etc/pterodactyl && sudo wings configure --panel-url {{ config('app.url') }} --token ${data.token} --node ${data.node}{{ config('app.debug') ? ' --allow-insecure' : '' }}`;

            Swal.fire({
                title: 'Deployment Command Generated',
                icon: 'success',
                html: `
                    <div class="text-left">
                        <p class="mb-2 text-gray-200">Run this command on your node server:</p>
                        <div class="bg-background/50 rounded-lg p-3 font-mono text-sm text-gray-200">
                            <code>${command}</code>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Copy & Close',
                showCancelButton: true,
                cancelButtonText: 'Close',
                customClass: {
                    popup: 'bg-background-darker border border-gray-700',
                    title: 'text-gray-100',
                    htmlContainer: 'text-gray-200',
                    confirmButton: 'bg-accent-purple hover:bg-accent-purple/80 text-white px-4 py-2 rounded-lg transition-colors',
                    cancelButton: 'bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText(command).then(() => {
                        Swal.fire({
                            title: 'Copied!',
                            text: 'Command copied to clipboard',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'bg-background-darker border border-gray-700',
                                title: 'text-gray-100',
                                htmlContainer: 'text-gray-200'
                            }
                        });
                    });
                }
            });
        }).fail(function () {
            Swal.fire({
                title: 'Error',
                text: 'Something went wrong creating your token.',
                icon: 'error',
                customClass: {
                    popup: 'bg-background-darker border border-gray-700',
                    title: 'text-gray-100',
                    htmlContainer: 'text-gray-200',
                    confirmButton: 'bg-accent-purple hover:bg-accent-purple/80 text-white px-4 py-2 rounded-lg transition-colors'
                }
            });
        });
    });
</script>

<style>
    /* SweetAlert2 Custom Styles */
    .swal2-popup {
        font-family: inherit;
    }

    .swal2-popup code {
        word-break: break-all;
        white-space: pre-wrap;
    }

    /* Hide SweetAlert2 icon background */
    .swal2-icon.swal2-success,
    .swal2-icon.swal2-error {
        border-color: transparent !important;
        background: transparent !important;
    }

    /* Style SweetAlert2 success icon */
    .swal2-success-line-tip,
    .swal2-success-line-long {
        background-color: rgb(var(--color-accent-purple)) !important;
    }

    .swal2-success-ring {
        border-color: rgb(var(--color-accent-purple)) !important;
    }

    /* Style SweetAlert2 error icon */
    .swal2-x-mark-line-left,
    .swal2-x-mark-line-right {
        background-color: rgb(239, 68, 68) !important;
    }
</style>
@endsection
