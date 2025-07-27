<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use Carbon\Carbon;
use Illuminate\View\View;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Admin\AdminActivityLogService;

class LogsController extends Controller
{
    public function __construct(protected AdminActivityLogService $activityLogService)
    {
    }

    protected function getLogPath(): string
    {
        return storage_path('logs/laravel-'.date('Y-m-d').'.log');
    }

    public function index(): View
    {
        $logPath = $this->getLogPath();
        try {
            if (!\File::exists($logPath)) {
                return view('admin.mythicalsystems.logs', ['logs' => []]);
            }

            $logs = collect(explode(PHP_EOL, \File::get($logPath)))
                ->filter()
                ->map(function ($line) {
                    if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*?)( in .*?:\d+)?$/', $line, $matches)) {
                        return (object)[
                            'datetime' => Carbon::createFromFormat('Y-m-d H:i:s', $matches[1]),
                            'level' => strtolower($matches[3]),
                            'message' => $matches[4],
                            'stack' => $matches[5] ?? null
                        ];
                    }
                    return null;
                })
                ->filter()
                ->sortByDesc('datetime')
                ->values();

            $this->activityLogService->log(
                'admin.mythicalsystems.logs',
                auth()->user()->id,
                'Viewed logs'
            );

            return view('admin.mythicalsystems.logs', [
                'logs' => $logs->toArray()
            ]);
        } catch (\Exception $e) {
            return view('admin.mythicalsystems.logs', ['logs' => []]);
        }
    }

    public function clearLogs()
    {
        $logPath = $this->getLogPath();
        if (\File::exists($logPath)) {
            \File::delete($logPath);
        }
        $this->activityLogService->log(
            'admin.mythicalsystems.logs',
            auth()->user()->id,
            'Cleared logs'
        );
        return redirect()->back();
    }

    public function downloadLogs()
    {
        $logPath = $this->getLogPath();
        if (!\File::exists($logPath)) {
            // Create empty file if it doesn't exist
            \File::put($logPath, '');
        }
        $this->activityLogService->log(
            'admin.mythicalsystems.logs',
            auth()->user()->id,
            'Downloaded logs'
        );
        return response()->download($logPath);
    }
}
