// app/Http/Controllers/Admin/VersionController.php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Pterodactyl\Services\Helpers\SoftwareVersionService;

class VersionController extends Controller
{
    public function refresh(): RedirectResponse
    {
        Cache::forget(SoftwareVersionService::VERSION_CACHE_KEY);
        new SoftwareVersionService(app('cache.store'), app('GuzzleHttp\Client'));

        return redirect()->back()->with('success', 'Version data refreshed!');
    }
}
