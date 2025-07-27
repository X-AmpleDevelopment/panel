@if (count($errors) > 0)
    <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4 mb-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <div>
                <h3 class="font-medium text-red-500">There were errors with your submission</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@foreach (Alert::getMessages() as $type => $messages)
    @foreach ($messages as $message)
        <div
            class="bg-{{ $type === 'success' ? 'green' : 'blue' }}-500/10 border border-{{ $type === 'success' ? 'green' : 'blue' }}-500/20 rounded-lg p-4 mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-info-circle text-{{ $type === 'success' ? 'green' : 'blue' }}-500"></i>
                <div class="text-sm text-{{ $type === 'success' ? 'green' : 'blue' }}-400">
                    {!! $message !!}
                </div>
            </div>
        </div>
    @endforeach
@endforeach
