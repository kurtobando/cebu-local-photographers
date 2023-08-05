<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;

class SignInController extends Controller
{
    public function index()
    {
        return inertia('TheSignIn');
    }

    public function store(SignInRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'), true)) {
            return redirect()
                ->route('sign-in')
                ->with(['error' => 'Make sure you have the correct email address and password, then try again.']);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
