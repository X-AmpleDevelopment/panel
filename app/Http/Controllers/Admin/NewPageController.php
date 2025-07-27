<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\View\View;
use Pterodactyl\Http\Controllers\Controller;

class NewPageController extends Controller
{
    public function index(): View
    {
        return view('admin.newpage');
    }
}
