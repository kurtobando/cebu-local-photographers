<?php

namespace App\Http\Controllers;

use App\Events\PasswordResetEvent;
use App\Http\Requests\PasswordResetRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function __construct(
        private readonly User               $user,
        private readonly PasswordResetEvent $passwordResetEvent,
        private readonly PasswordResetToken $passwordResetToken
    )
    {
        //
    }

    public function index()
    {
        return inertia('ThePasswordReset');
    }

    public function store(PasswordResetRequest $request)
    {
        if ($this->user->where('email', $request->email)->where('is_active', true)->doesntExist()) {
            return redirect()
                ->route('password-reset')
                ->withErrors(['email' => 'This email address is no longer active status. If you wish to continue with the password reset, please contact our support team.']);
        }

        $token = $this->passwordResetToken->create([
            'email' => $request->email,
            'token' => Hash::make(now()),
            'is_used' => false
        ]);

        $this->passwordResetEvent->dispatch($token);

        return redirect()
            ->route('password-reset')
            ->with('success', 'We sent you an email with a link to reset your password.');
    }
}
