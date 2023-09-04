<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardPhotosController extends Controller
{
    public function create()
    {
        return inertia('Dashboard/TheDashboardPhotos');
    }
}
