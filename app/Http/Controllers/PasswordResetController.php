<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Inertia\Inertia;

class PasswordResetController extends Controller
{
    public function index()
    {
        return Inertia::render('ThePasswordReset');
    }

    public function store(PasswordResetRequest $request)
    {
        if (User::where('email', $request->email)->where('is_active', true)->doesntExist()) {
            return redirect()
                ->route('password-reset')
                ->withErrors(['email' => 'This email address is no longer active status. If you wish to continue with the password reset, please contact our support team.']);
        }

        // TODO! send password reset email, with token
        
        return redirect()
            ->route('password-reset')
            ->with('success', 'We have emailed your password reset link!');
    }
}
