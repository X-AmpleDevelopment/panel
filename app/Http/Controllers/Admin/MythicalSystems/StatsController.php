<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use Carbon\Carbon;
use Illuminate\View\View;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Models\Node;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Models\Server;
use Pterodactyl\Services\Admin\AdminActivityLogService;

class StatsController extends Controller
{
    public function __construct(
        private ViewFactory $view,
        private ConfigRepository $config,
        private SettingsRepositoryInterface $settings,
        protected AdminActivityLogService $activityLogService
    ) {
    }
    public function index(): View
    {
        $cacheTime = 1800;

        $servers = cache()->remember('servers', $cacheTime, function () {
            return Server::all();
        });

        $nodes = cache()->remember('nodes', $cacheTime, function () {
            return Node::all();
        });

        $totalServerRam = cache()->remember('totalServerRam', $cacheTime, function () use ($servers) {
            return $servers->sum('memory');
        });

        $totalServerDisk = cache()->remember('totalServerDisk', $cacheTime, function () use ($servers) {
            return $servers->sum('disk');
        });

        $totalNodeRam = cache()->remember('totalNodeRam', $cacheTime, function () use ($nodes) {
            return $nodes->sum('memory');
        });

        $totalNodeDisk = cache()->remember('totalNodeDisk', $cacheTime, function () use ($nodes) {
            return $nodes->sum('disk');
        });

        $totalAllocations = cache()->remember('totalAllocations', $cacheTime, function () use ($nodes) {
            return $nodes->sum(function ($node) {
                return $node->allocations->count();
            });
        });

        $eggsCount = cache()->remember('eggsCount', $cacheTime, function () {
            return \Pterodactyl\Models\Egg::count();
        });

        $usersCount = cache()->remember('usersCount', $cacheTime, function () {
            return \Pterodactyl\Models\User::count();
        });

        $databasesCount = cache()->remember('databasesCount', $cacheTime, function () {
            return \Pterodactyl\Models\Database::count();
        });

        $totalSuspensionServers = cache()->remember('totalSuspensionServers', $cacheTime, function () use ($servers) {
            return $servers->filter(function ($server) {
                return $server->isSuspended();
            })->count();
        });

        $serversCount = $servers->count();
        $nodesCount = $nodes->count();

        if (!is_numeric($serversCount)) {
            $serversCount = 0;

        }

        if (!is_numeric($nodesCount)) {
            $nodesCount = 0;
        }
        $totalNodes = $nodes->sum(function ($node) {
            return $node->count();
        });
        $serversCountF = $serversCount;
        $nodesCountF = $nodesCount;

        /**
         * Format the numbers
         */
        $totalAllocations = self::format($totalAllocations);
        $serversCountF = self::format($serversCount);
        $nodesCountF = self::format($nodesCount);
        $usersCount = self::format($usersCount);
        $eggsCount = self::format($eggsCount);
        $databasesCount = self::format($databasesCount);

        $useddiskInGB = round($totalServerDisk / 1024);
        $usedramInGB = round($totalServerRam / 1024);

        $totalNodeRamGB = round($totalNodeRam / 1024);
        $totalNodeDiskGB = round($totalNodeDisk / 1024);

        $this->activityLogService->log(
            'admin.mythicalsystems.stats',
            auth()->user()->id,
            'Viewed stats'
        );

        return view('admin.mythicalsystems.stats', [
            'serversCountFormatted' => $serversCountF,
            'nodesCountFormatted' => $nodesCountF,
            'totalServerRam' => $totalServerRam,
            'serversCount' => $serversCount,
            'totalServerDisk' => $totalServerDisk,
            'totalNodeRam' => $totalNodeRam,
            'totalNodeDisk' => $totalNodeDisk,
            'totalNodeDiskGB' => $totalNodeDiskGB,
            'totalNodeRamGB' => $totalNodeRamGB,
            'totalAllocations' => $totalAllocations,
            'eggsCount' => $eggsCount,
            'usersCount' => $usersCount,
            'nodesCount' => $nodesCount,
            'databasesCount' => $databasesCount,
            'totalSuspendedServers' => $totalSuspensionServers,
            'useddiskInGB' => $useddiskInGB,
            'usedramInGB' => $usedramInGB,
            'totalNodes' => $totalNodes,
        ]);
    }
    private static $numberFormat = null;

    private static function getNumberFormat()
    {
        if (self::$numberFormat === null) {
            self::$numberFormat = explode(';', "k;M;B;T;Q;QQ;S;SS;OC;N;D;UN;DD;TR;QT;QN;SD;SPD;OD;ND;VG;UVG;DVG;TVG;QTV;QNV;SEV;SPV;OVG;NVG;TG");
        }
        return self::$numberFormat;
    }

    private static function formatLarge($n, $iteration)
    {
        $f = $n / 1000.0;
        return $f < 1000 || $iteration >= count(self::getNumberFormat()) - 1 ?
            number_format($f, 1) . self::getNumberFormat()[$iteration] : self::formatLarge($f, $iteration + 1);
    }

    public static function format($value)
    {
        return $value < 1000 ? $value : self::formatLarge($value, 0);
    }
}
