<?php

namespace App\Http\Controllers;

use App\Events\PasswordResetEvent;
use App\Http\Requests\PasswordResetRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

       $passwordResetToken = PasswordResetToken::create([
            'email' => $request->email,
            'token' => Hash::make(now()),
            'is_used' => false
        ]);

        PasswordResetEvent::dispatch(User::where('email', $request->email)->first(), $passwordResetToken->token);

        return redirect()
            ->route('password-reset')
            ->with('success', 'We sent you an email with a link to reset your password.');
    }
}
