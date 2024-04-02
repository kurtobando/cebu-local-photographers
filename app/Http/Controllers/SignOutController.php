<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class SignOutController extends Controller
{
    public function store(): RedirectResponse
    {
        auth()->logout();

        session()->regenerate();

        return redirect()->route('home');
    }
}
