<?php

namespace App\Http\Controllers\Public\Auth;

use App\Enums\UserAuthProviderEnum;
use App\Events\PasswordResetEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthPasswordResetRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Response;

class AuthPasswordResetController extends Controller
{
    public function __construct(
        private readonly User $user,
        private readonly PasswordResetEvent $passwordResetEvent,
        private readonly PasswordResetToken $passwordResetToken
    ) {
    }

    public function index(): Response
    {
        return inertia('ThePasswordReset');
    }

    public function store(AuthPasswordResetRequest $request): RedirectResponse
    {
        if (
            $this
                ->user
                ->where('email', $request->email)
                ->where('is_active', true)
                ->where('provider', UserAuthProviderEnum::DEFAULT->value)
                ->doesntExist()
        ) {
            return redirect()
                ->route('password-reset')
                ->withErrors(['email' => 'This email address is no longer active status. If you wish to continue with the password reset, please contact our support team.']);
        }

        $token = $this->passwordResetToken->create([
            'email' => $request->email,
            'token' => Hash::make(now()),
            'is_used' => false,
        ]);

        $this->passwordResetEvent->dispatch($token);

        return redirect()
            ->route('password-reset')
            ->with('success', 'We sent you an email with a link to reset your password.');
    }
}
