<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardUserController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/TheDashboardUser');
    }
}
