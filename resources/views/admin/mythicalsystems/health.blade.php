@extends('layouts.admin')

@section('title')
    System Health
@endsection

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-100">
            <div class="flex items-center space-x-4">
                <div class="p-2 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-heartbeat text-accent-purple"></i>
                </div>
                <div>
                    System Health
                    <small class="block mt-1 text-base font-normal text-gray-400">Monitor your application's health and performance metrics</small>
                </div>
            </div>
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- System Overview -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">System Overview</h3>
            </div>
            <div class="p-5 space-y-4">
                <!-- PHP Version -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">PHP Version</span>
                    <span class="px-3 py-1 bg-green-500/10 text-green-500 rounded-lg">{{ phpversion() }}</span>
                </div>

                <!-- Laravel Version -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Laravel Version</span>
                    <span class="px-3 py-1 bg-green-500/10 text-green-500 rounded-lg">{{ app()->version() }}</span>
                </div>

                <!-- Environment -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Environment</span>
                    <span class="px-3 py-1 {{ app()->environment('production') ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }} rounded-lg">
                        {{ app()->environment() }}
                    </span>
                </div>

                <!-- Debug Mode -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Debug Mode</span>
                    <span class="px-3 py-1 {{ config('app.debug') ? 'bg-yellow-500/10 text-yellow-500' : 'bg-green-500/10 text-green-500' }} rounded-lg">
                        {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>

                <!-- Cache Status -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Cache Status</span>
                    <span class="px-3 py-1 {{ cache()->get('health_check_key') ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} rounded-lg">
                        {{ cache()->get('health_check_key') ? 'Working' : 'Not Working' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Server Resources -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Server Resources</h3>
            </div>
            <div class="p-5 space-y-4">
                <!-- CPU Usage -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-400">CPU Usage</span>
                        <span class="text-gray-400">{{ $cpuUsage }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2.5">
                        <div class="bg-accent-purple h-2.5 rounded-full" style="width: {{ $cpuUsage }}%"></div>
                    </div>
                </div>

                <!-- Memory Usage -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-400">Memory Usage</span>
                        <span class="text-gray-400">{{ $memoryUsage }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2.5">
                        <div class="bg-accent-purple h-2.5 rounded-full" style="width: {{ $memoryUsage }}%"></div>
                    </div>
                </div>

                <!-- Disk Usage -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-400">Disk Usage</span>
                        <span class="text-gray-400">{{ $diskUsage }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2.5">
                        <div class="bg-accent-purple h-2.5 rounded-full" style="width: {{ $diskUsage }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Health -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Database Health</h3>
            </div>
            <div class="p-5 space-y-4">
                <!-- Connection Status -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Connection Status</span>
                    <span class="px-3 py-1 {{ $dbStatus ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} rounded-lg">
                        {{ $dbStatus ? 'Connected' : 'Disconnected' }}
                    </span>
                </div>

                <!-- Database Size -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Database Size</span>
                    <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg">{{ $dbSize }}</span>
                </div>

                <!-- Open Connections -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Open Connections</span>
                    <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg">{{ $dbConnections }}</span>
                </div>
            </div>
        </div>

        <!-- Queue Health -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Queue Health</h3>
            </div>
            <div class="p-5 space-y-4">
                <!-- Queue Driver -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Queue Driver</span>
                    <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg">{{ config('queue.default') }}</span>
                </div>

                <!-- Failed Jobs -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Failed Jobs</span>
                    <span class="px-3 py-1 {{ $failedJobs > 0 ? 'bg-red-500/10 text-red-500' : 'bg-green-500/10 text-green-500' }} rounded-lg">
                        {{ $failedJobs }}
                    </span>
                </div>

                <!-- Pending Jobs -->
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Pending Jobs</span>
                    <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg">{{ $pendingJobs }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent System Logs -->
    <div class="mt-8">
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold gradient-text">Failed Jobs</h3>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs uppercase bg-background/50">
                            <tr>
                                <th class="p-3">Time</th>
                                <th class="p-3">Queue</th>
                                <th class="p-3">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentLogs as $log)
                                <tr class="border-b border-gray-700 last:border-0">
                                    <td class="p-3 whitespace-nowrap">{{ $log->failed_at }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded-lg text-xs
                                            @switch($log->queue)
                                                @case('error')
                                                    bg-red-500/10 text-red-500
                                                    @break
                                                @case('warning')
                                                    bg-yellow-500/10 text-yellow-500
                                                    @break
                                                @default
                                                    bg-green-500/10 text-green-500
                                            @endswitch
                                        ">
                                            {{ ucfirst($log->queue) }}
                                        </span>
                                    </td>
                                    <td class="p-3">{{ $log->exception }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Refresh the page every 30 seconds to update metrics
            setTimeout(function() {
                window.location.reload();
            }, 30000);
        </script>
    @endpush
@endsection
