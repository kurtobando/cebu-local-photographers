<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardProfileController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/TheDashboardProfile');
    }

    public function update()
    {
        dd('TODO!');
    }
}
