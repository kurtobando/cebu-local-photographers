<?php

namespace App\Http\Controllers\Public\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AuthSignOutController extends Controller
{
    public function store(): RedirectResponse
    {
        auth()->logout();

        session()->regenerate();

        return redirect()->route('home');
    }
}
