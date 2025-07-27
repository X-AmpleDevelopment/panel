<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HealthController extends \Pterodactyl\Http\Controllers\Controller
{
    public function index()
    {
        // Set a test key in cache
        Cache::put('health_check_key', true, 60);

        // Get system metrics
        $cpuUsage = $this->getCpuUsage();
        $memoryUsage = $this->getMemoryUsage();
        $diskUsage = $this->getDiskUsage();

        // Get database metrics
        try {
            DB::connection()->getPdo();
            $dbStatus = true;
        } catch (\Exception $e) {
            $dbStatus = false;
        }

        $dbSize = $this->getDatabaseSize();
        $dbConnections = $this->getDatabaseConnections();

        // Get queue metrics
        $failedJobs = DB::table('failed_jobs')->count();
        $pendingJobs = DB::table('jobs')->count();

        // Get recent logs
        $recentLogs = $this->getRecentLogs();

        return view('admin.mythicalsystems.health', compact(
            'cpuUsage',
            'memoryUsage',
            'diskUsage',
            'dbStatus',
            'dbSize',
            'dbConnections',
            'failedJobs',
            'pendingJobs',
            'recentLogs'
        ));
    }

    private function getCpuUsage()
    {
        if (PHP_OS_FAMILY === 'Linux') {
            $load = sys_getloadavg();
            $cores = (int) shell_exec('nproc');
            return round($load[0] * 100 / ($cores ?: 1));
        }
        return 0;
    }

    private function getMemoryUsage()
    {
        if (PHP_OS_FAMILY === 'Linux') {
            $free = shell_exec('free');
            $free = (string)trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);
            return round($mem[2]/$mem[1]*100);
        }
        return 0;
    }

    private function getDiskUsage()
    {
        return round(disk_free_space('/') / disk_total_space('/') * 100);
    }

    private function getDatabaseSize()
    {
        try {
            $result = DB::select('SELECT pg_size_pretty(pg_database_size(?)) as size', [config('database.connections.pgsql.database')]);
            return $result[0]->size;
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    private function getDatabaseConnections()
    {
        try {
            $result = DB::select('SELECT count(*) as count FROM pg_stat_activity');
            return $result[0]->count;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getRecentLogs()
    {
        // This assumes you're using a database logger
        // You might need to adjust this based on your logging setup
        return DB::table('failed_jobs')
            ->orderBy('failed_at', 'desc')
            ->limit(10)
            ->get();
    }
}
