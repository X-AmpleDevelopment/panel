@extends('layouts.admin')

@section('title')
System Logs
@endsection

@section('content')
<h1 class="text-3xl font-bold text-gray-100">
    <div class="flex items-center space-x-4">
        <div class="p-2 bg-accent-purple/10 rounded-lg">
            <i class="fas fa-clipboard-list text-accent-purple"></i>
        </div>
        <div>
            System Logs
            <small class="block mt-1 text-base font-normal text-gray-400">View and analyze system logs and
                activities.</small>
        </div>
    </div>
</h1>
<br>

<div class="glass-card rounded-lg overflow-hidden">
    <div class="p-4 border-b border-gray-700 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <select id="logLevel" class="bg-background text-white rounded-lg border border-gray-700 px-3 py-2 text-sm">
                <option value="all">All Levels</option>
                <option value="emergency">Emergency</option>
                <option value="alert">Alert</option>
                <option value="critical">Critical</option>
                <option value="error">Error</option>
                <option value="warning">Warning</option>
                <option value="notice">Notice</option>
                <option value="info">Info</option>
                <option value="debug">Debug</option>
            </select>
            <input type="text" id="searchLogs" placeholder="Search logs..."
                class="bg-background text-white rounded-lg border border-gray-700 px-3 py-2 text-sm">
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="downloadLogs()"
                class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg hover:bg-blue-500/20 transition-colors">
                <i class="fas fa-download mr-2"></i>Download Logs
            </button>
            <button onclick="clearLogs()"
                class="px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors">
                <i class="fas fa-trash-alt mr-2"></i>Clear Logs
            </button>
        </div>

    </div>

    <div class="overflow-x-auto">
        <div class="logs-container max-h-[600px] overflow-y-auto p-4 space-y-2">
            @foreach($logs as $log)
                        <div class="log-entry p-3 rounded-lg bg-background-darker border border-gray-700/50 hover:border-gray-700 transition-colors"
                            data-level="{{ $log->level }}">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-3">
                                    <div @class([
                    'px-2 py-1 rounded text-xs font-medium',
                    'bg-red-500/10 text-red-400' => $log->level === 'error' || $log->level === 'critical' || $log->level === 'emergency',
                    'bg-yellow-500/10 text-yellow-400' => $log->level === 'warning',
                    'bg-blue-500/10 text-blue-400' => $log->level === 'info',
                    'bg-gray-500/10 text-gray-400' => $log->level === 'debug',
                ])>
                                        {{ strtoupper($log->level) }}
                                    </div>
                                    <span class="text-gray-400 text-sm">{{ $log->datetime->format('Y-m-d H:i:s') }}</span>
                                </div>
                                <button onclick="copyLog(this)" class="text-gray-500 hover:text-gray-300 transition-colors">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="mt-2 text-sm text-gray-300 font-mono">
                                {{ $log->message }}
                            </div>
                            @if($log->stack)
                                <div class="mt-2 text-xs text-gray-400 font-mono overflow-x-auto">
                                    <pre class="whitespace-pre-wrap">{{ $log->stack }}</pre>
                                </div>
                            @endif
                        </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.getElementById('logLevel').addEventListener('change', function () {
        const level = this.value;
        const entries = document.querySelectorAll('.log-entry');

        entries.forEach(entry => {
            if (level === 'all' || entry.dataset.level === level) {
                entry.style.display = 'block';
            } else {
                entry.style.display = 'none';
            }
        });
    });

    document.getElementById('searchLogs').addEventListener('input', function () {
        const search = this.value.toLowerCase();
        const entries = document.querySelectorAll('.log-entry');

        entries.forEach(entry => {
            if (entry.textContent.toLowerCase().includes(search)) {
                entry.style.display = 'block';
            } else {
                entry.style.display = 'none';
            }
        });
    });

    function copyLog(button) {
        const logEntry = button.closest('.log-entry');
        const logText = logEntry.textContent;

        navigator.clipboard.writeText(logText).then(() => {
            const icon = button.querySelector('i');
            icon.className = 'fas fa-check';
            setTimeout(() => {
                icon.className = 'fas fa-copy';
            }, 2000);
        });
    }

    function clearLogs() {
        if (confirm('Are you sure you want to clear all logs? This action cannot be undone.')) {
            fetch('/admin/mythicalsystems/logs/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                window.location.reload();
            });
        }
    }

    function downloadLogs() {
        window.location.href = '{{ route('admin.mythicalsystems.logs.download') }}';
    }
</script>
@endsection
