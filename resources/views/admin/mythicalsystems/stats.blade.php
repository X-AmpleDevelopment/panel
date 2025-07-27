@extends('layouts.admin')

@section('title')
    System Statistics
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-chart-line text-accent-purple"></i>
            </div>
            <div>
                System Statistics
                <small class="block mt-1 text-base font-normal text-gray-400">Overview of system resources and usage</small>
            </div>
        </div>
    </h1>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Servers -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-blue-500/10 rounded-lg">
                    <i class="fas fa-server text-blue-400 text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Total Servers</p>
                    <p class="text-2xl font-bold text-gray-100">{{ $serversCountFormatted }}</p>
                </div>
            </div>
        </div>

        <!-- Memory Usage -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-purple-500/10 rounded-lg">
                    <i class="fas fa-memory text-purple-400 text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Memory Usage</p>
                    <p class="text-2xl font-bold text-gray-100">{{ $usedramInGB }}GB</p>
                    <p class="text-xs text-gray-500">of {{ $totalNodeRamGB }}GB</p>
                </div>
            </div>
        </div>

        <!-- Disk Usage -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-green-500/10 rounded-lg">
                    <i class="fas fa-hdd text-green-400 text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Disk Usage</p>
                    <p class="text-2xl font-bold text-gray-100">{{ $useddiskInGB }}GB</p>
                    <p class="text-xs text-gray-500">of {{ $totalNodeDiskGB }}GB</p>
                </div>
            </div>
        </div>

        <!-- Allocations -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-yellow-500/10 rounded-lg">
                    <i class="fas fa-network-wired text-yellow-400 text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Total Allocations</p>
                    <p class="text-2xl font-bold text-gray-100">{{ $totalAllocations }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- RAM Chart -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-gray-100">Memory Distribution</h3>
            </div>
            <div class="p-4">
                <canvas id="ram_chart" height="200"></canvas>
            </div>
        </div>

        <!-- Disk Chart -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-gray-100">Disk Usage</h3>
            </div>
            <div class="p-4">
                <canvas id="disk_chart" height="200"></canvas>
            </div>
        </div>

        <!-- Server Status Chart -->
        <div class="glass-card rounded-lg overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-gray-100">Server Status</h3>
            </div>
            <div class="p-4">
                <canvas id="server_chart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Additional Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Users -->
        <div class="glass-card p-4 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-indigo-500/10 rounded-lg">
                    <i class="fas fa-users text-indigo-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Users</p>
                    <p class="text-lg font-semibold text-gray-100">{{ $usersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Nodes -->
        <div class="glass-card p-4 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-red-500/10 rounded-lg">
                    <i class="fas fa-server text-red-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Nodes</p>
                    <p class="text-lg font-semibold text-gray-100">{{ $nodesCountFormatted }}</p>
                </div>
            </div>
        </div>

        <!-- Eggs -->
        <div class="glass-card p-4 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-emerald-500/10 rounded-lg">
                    <i class="fas fa-gamepad text-emerald-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Eggs</p>
                    <p class="text-lg font-semibold text-gray-100">{{ $eggsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Databases -->
        <div class="glass-card p-4 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-cyan-500/10 rounded-lg">
                    <i class="fas fa-database text-cyan-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Databases</p>
                    <p class="text-lg font-semibold text-gray-100">{{ $databasesCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Form -->
<form class="hidden">
    <input type="hidden" id="totalNodeRam" value="{{ $totalNodeRam }}">
    <input type="hidden" id="totalServerRam" value="{{ $totalServerRam }}">
    <input type="hidden" id="totalNodeDisk" value="{{ $totalNodeDisk }}">
    <input type="hidden" id="totalServerDisk" value="{{ $totalServerDisk }}">
    <input type="hidden" id="serversCount" value="{{ $serversCount }}">
    <input type="hidden" id="totalSuspendedServers" value="{{ $totalSuspendedServers }}">
</form>

@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/chartjs/chart.min.js') !!}
    <script>
        const chartColors = {
            blue: '#3B82F6',
            green: '#10B981',
            red: '#EF4444',
            yellow: '#F59E0B',
            purple: '#8B5CF6',
            gray: '#6B7280'
        };

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#9CA3AF',
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        };

        function grabCache() {
            return {
                totalNodeRam: document.getElementById('totalNodeRam').value,
                totalServerRam: document.getElementById('totalServerRam').value,
                totalNodeDisk: document.getElementById('totalNodeDisk').value,
                totalServerDisk: document.getElementById('totalServerDisk').value,
                serversCount: document.getElementById('serversCount').value,
                suspendedServers: document.getElementById('totalSuspendedServers').value,
            }
        }

        const cache = grabCache();

        // RAM Chart
        const freeRam = cache.totalNodeRam - cache.totalServerRam;
        new Chart(document.getElementById('ram_chart'), {
            type: 'doughnut',
            data: {
                labels: ['Free RAM', 'Used RAM'],
                datasets: [{
                    data: [freeRam, cache.totalServerRam],
                    backgroundColor: [chartColors.green, chartColors.blue],
                    borderWidth: 0
                }]
            },
            options: chartOptions
        });

        // Disk Chart
        const freeDisk = cache.totalNodeDisk - cache.totalServerDisk;
        new Chart(document.getElementById('disk_chart'), {
            type: 'doughnut',
            data: {
                labels: ['Free Space', 'Used Space'],
                datasets: [{
                    data: [freeDisk, cache.totalServerDisk],
                    backgroundColor: [chartColors.green, chartColors.purple],
                    borderWidth: 0
                }]
            },
            options: chartOptions
        });

        // Server Status Chart
        new Chart(document.getElementById('server_chart'), {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Suspended'],
                datasets: [{
                    data: [cache.serversCount, cache.suspendedServers],
                    backgroundColor: [chartColors.green, chartColors.red],
                    borderWidth: 0
                }]
            },
            options: chartOptions
        });
    </script>
@endsection
