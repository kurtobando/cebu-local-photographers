<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return inertia('Dashboard/TheDashboard');
    }
}
