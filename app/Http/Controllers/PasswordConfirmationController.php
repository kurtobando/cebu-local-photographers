<?php

namespace App\Http\Controllers;

use App\Events\PasswordConfirmationEvent;
use App\Http\Requests\PasswordConfirmationRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordConfirmationController extends Controller
{
    public function __construct(
        private readonly User $user,
        private readonly PasswordResetToken $passwordResetToken,
        private readonly PasswordConfirmationEvent $passwordConfirmationEvent
    ) {
        //
    }

    public function index()
    {
        $token = request()->query('token') ?? null;
        $email = request()->query('email') ?? null;

        abort_if(is_null($token), 403, 'Token is required.');
        abort_if(is_null($email), 403, 'Email is required.');
        abort_if(!$this->isTokenValid($token, $email), 403, 'Token is invalid.');
        abort_if($this->isTokenUsed($token, $email), 404, 'Token is no longer valid.');

        return inertia('ThePasswordConfirmation', [ 'email' => $email, 'token' => $token ]);
    }

    public function update(PasswordConfirmationRequest $request)
    {
        $token = $request->token;
        $email = $request->email;

        if (!$this->isTokenValid($token, $email)) {
            return redirect()->route('password-confirmation')->with(['error' => 'This token is no longer valid.']);
        }
        if ($this->isTokenUsed($token, $email)) {
            return redirect()->route('password-confirmation')->with(['error' => 'This token is no longer valid.']);
        }

        $this->user->where('email', $email)->update(['password' => Hash::make($request->password)]);
        $this->passwordResetToken->where('email', $email)->where('token', $token)->update(['is_used' => true]);
        $this->passwordConfirmationEvent->dispatch($this->user->where('email', $email)->first());

        return redirect()->route('sign-in')->with('success', 'Your password has been reset. You can now sign in.');
    }

    private function isTokenValid(string $token, string $email): bool
    {
        return $this->passwordResetToken->where('token', $token)->where('email', $email)->where('is_used', false)->exists();
    }

    private function isTokenUsed(string $token, string $email): bool
    {
        return $this->passwordResetToken->where('token', $token)->where('email', $email)->where('is_used', true)->exists();
    }
}
