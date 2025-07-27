<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Admin\AdminActivityLogService;

class ActivityController extends Controller
{
    public function __construct(protected AdminActivityLogService $activityLogService)
    {
    }

    public function index(): View
    {
        return view('admin.activity.index', [
            'activities' => $this->activityLogService->getLatest()
        ]);
    }

    public function delete(int $id): RedirectResponse
    {
        $this->activityLogService->delete($id);

        return redirect()->route('admin.activity.index')
            ->with('success', 'Activity log entry has been deleted.');
    }
}
