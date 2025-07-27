<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Models\Egg;
use Pterodactyl\Models\Node;
use Pterodactyl\Models\Server;
use Pterodactyl\Models\User;
use Pterodactyl\Services\Helpers\SoftwareVersionService;
use Pterodactyl\Services\Admin\AdminActivityLogService;
class BaseController extends Controller
{
    /**
     * BaseController constructor.
     */
    public function __construct(private SoftwareVersionService $version, private ViewFactory $view, private AdminActivityLogService $activityLogService)
    {
    }

    /**
     * Return the admin index view.
     */
    public function index(): View
    {
        $stats = [
            'servers' => Server::all()->count(),
            'users' => User::all()->count(),
            'nodes' => Node::all()->count(),
            'eggs' => Egg::all()->count(),
        ];
        $activities = $this->activityLogService->getForActor(
            auth()->user()->id,
            5
        ) ?? collect();
        $news = [
    [
        'title' => 'X-Ample Control Panel v1.11.12 Released',
        'date' => '2025-07-23',
        'description' => 'Our panel now includes enhanced server monitoring, blueprint integration, and Discord SSO support. Designed for both performance and style.'
    ],
    ];
        return $this->view->make('admin.index', [
            'version' => $this->version,
            'stats' => $stats,
            'activities' => $activities,
            'news' => $news,
        ]);
    }
}
