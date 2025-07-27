@extends('layouts.admin')

@section('title')
    Mail Settings
@endsection


@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-envelope text-accent-purple"></i>
        </div>
        <div>
            Mail Settings
            <small class="block mt-1 text-base font-normal text-gray-400">Configure email delivery settings and SMTP credentials.</small>
        </div>
    </div>
</h1>
<br>
    <div class="glass-card rounded-xl overflow-hidden border border-gray-700/50">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold gradient-text">Email Settings</h3>
                <span class="px-3 py-1 text-xs bg-accent-blue/10 text-accent-blue rounded-full">
                    SMTP Configuration
                </span>
            </div>

            @if($disabled)
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                    <p class="text-blue-200">
                        This interface is limited to instances using SMTP as the mail driver. Please either use <code class="bg-blue-500/20 px-1 py-0.5 rounded">php artisan p:environment:mail</code> command to update your email settings, or set <code class="bg-blue-500/20 px-1 py-0.5 rounded">MAIL_DRIVER=smtp</code> in your environment file.
                    </p>
                </div>
            @else
                <form id="mail-settings-form">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="smtp-host" class="block text-sm font-medium text-gray-200">SMTP Host</label>
                                <input type="text" id="smtp-host" name="mail:mailers:smtp:host" value="{{ old('mail:mailers:smtp:host', config('mail.mailers.smtp.host')) }}" required
                                    class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">Enter the SMTP server address that mail should be sent through.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="smtp-port" class="block text-sm font-medium text-gray-200">SMTP Port</label>
                                <input type="number" id="smtp-port" name="mail:mailers:smtp:port" value="{{ old('mail:mailers:smtp:port', config('mail.mailers.smtp.port')) }}" required class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">Enter the SMTP server port that mail should be sent through.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="smtp-encryption" class="block text-sm font-medium text-gray-200">Encryption</label>
                                <select id="smtp-encryption" name="mail:mailers:smtp:encryption" class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                    @php
                                        $encryption = old('mail:mailers:smtp:encryption', config('mail.mailers.smtp.encryption'));
                                    @endphp
                                    <option value="" @if($encryption === '') selected @endif>None</option>
                                    <option value="tls" @if($encryption === 'tls') selected @endif>Transport Layer Security (TLS)</option>
                                    <option value="ssl" @if($encryption === 'ssl') selected @endif>Secure Sockets Layer (SSL)</option>
                                </select>
                                <p class="text-xs text-gray-400">Select the type of encryption to use when sending mail.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="smtp-username" class="block text-sm font-medium text-gray-200">Username <span class="text-gray-400">(optional)</span></label>
                                <input type="text" id="smtp-username" name="mail:mailers:smtp:username" value="{{ old('mail:mailers:smtp:username', config('mail.mailers.smtp.username')) }}" class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">The username to use when connecting to the SMTP server.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="smtp-password" class="block text-sm font-medium text-gray-200">Password <span class="text-gray-400">(optional)</span></label>
                                <input type="password" id="smtp-password" name="mail:mailers:smtp:password" class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">The password to use in conjunction with the SMTP username. Leave blank to continue using the existing password. To set the password to an empty value enter <code class="bg-gray-700 px-1 py-0.5 rounded">!e</code> into the field.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="mail-from" class="block text-sm font-medium text-gray-200">Mail From</label>
                                <input type="email" id="mail-from" name="mail:from:address" value="{{ old('mail:from:address', config('mail.from.address')) }}" required class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">Enter an email address that all outgoing emails will originate from.</p>
                            </div>
                            <div class="space-y-2">
                                <label for="mail-from-name" class="block text-sm font-medium text-gray-200">Mail From Name <span class="text-gray-400">(optional)</span></label>
                                <input type="text" id="mail-from-name" name="mail:from:name" value="{{ old('mail:from:name', config('mail.from.name')) }}" class="w-full px-4 py-2.5 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                                <p class="text-xs text-gray-400">The name that emails should appear to come from.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 px-6 py-4 bg-background-darker border-t border-gray-700/50 -mx-6 -mb-6 flex items-center justify-between">
                        <span class="text-sm text-gray-400">
                            <i class="fas fa-info-circle mr-2"></i>
                            Changes will be applied immediately
                        </span>
                        <div class="space-x-3">
                            {{ csrf_field() }}
                            <button type="button" id="testButton"
                                class="px-5 py-2.5 bg-accent-blue text-white rounded-lg hover:bg-accent-blue/80 transition-colors inline-flex items-center">
                                <i class="fas fa-vial mr-2"></i>
                                Test
                            </button>
                            <button type="button" id="saveButton"
                                class="px-5 py-2.5 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors inline-flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
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

@section('footer-scripts')
    @parent

    <script>
        function saveSettings() {
            return $.ajax({
                method: 'PATCH',
                url: '/admin/settings/mail',
                contentType: 'application/json',
                data: JSON.stringify(Object.fromEntries(new FormData(document.getElementById('mail-settings-form')))),
                headers: { 'X-CSRF-Token': $('input[name="_token"]').val() }
            }).fail(function (jqXHR) {
                showErrorDialog(jqXHR, 'save');
            });
        }

        function testSettings() {
            Swal.fire({
                title: 'Test Mail Settings',
                text: 'Click "Test" to begin the test.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Test',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        method: 'POST',
                        url: '/admin/settings/mail/test',
                        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                    }).catch(error => {
                        Swal.showValidationMessage(`Test failed: ${error.responseJSON?.error || error.responseText || 'Unknown error'}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Success', 'The test message was sent successfully.', 'success');
                }
            });
        }

        function saveAndTestSettings() {
            saveSettings().done(testSettings);
        }

        function showErrorDialog(jqXHR, verb) {
            console.error(jqXHR);
            var errorText = jqXHR.responseJSON?.error || jqXHR.responseJSON?.errors?.map(e => e.detail).join(' ') || jqXHR.responseText || 'Unknown error';
            Swal.fire('Whoops!', `An error occurred while attempting to ${verb} mail settings: ${errorText}`, 'error');
        }

        $(document).ready(function () {
            $('#testButton').on('click', saveAndTestSettings);
            $('#saveButton').on('click', function () {
                saveSettings().done(function () {
                    Swal.fire('Success', 'Mail settings have been updated successfully and the queue worker was restarted to apply these changes.', 'success');
                });
            });
        });
    </script>
@endsection

