<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use Illuminate\View\View;
use Pterodactyl\Http\Controllers\Controller;

class ApiTesterController extends Controller
{
    public function index(): View
    {
        return view('admin.mythicalsystems.api-tester');
    }
}
