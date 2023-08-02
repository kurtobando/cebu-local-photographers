<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function store() {
        auth()->logout();

        session()->regenerate();

        return redirect()->route('home');
    }
}
