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
                ->with('error', 'Your credentials are invalid, please try again.');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
