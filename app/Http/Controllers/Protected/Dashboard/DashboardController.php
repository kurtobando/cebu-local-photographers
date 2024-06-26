<?php

namespace App\Http\Controllers\Protected\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('home');
    }
}
