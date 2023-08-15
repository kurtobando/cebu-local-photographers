<?php

namespace App\Http\Controllers;

class SignOutController extends Controller
{
    public function store()
    {
        auth()->logout();

        session()->regenerate();

        return redirect()->route('home');
    }
}
