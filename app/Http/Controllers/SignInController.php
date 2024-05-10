<?php

namespace App\Http\Controllers;

use App\Events\UserSignInEvent;
use App\Http\Requests\SignInRequest;
use App\Services\SignInService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class SignInController extends Controller
{
    public function __construct(
        private readonly SignInService $signInService
    ) {

    }

    public function index(): Response| RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return inertia('TheSignIn');
    }

    public function store(SignInRequest $request): RedirectResponse
    {
        if (!$this->signInService->signIn($request->email, $request->password, true)) {
            return redirect()
                ->route('sign-in')
                ->with(['error' => 'Make sure you have the correct email address and password, then try again.']);
        }

        event(new UserSignInEvent(
            auth()->user(),
            $request->getClientIp(),
            $request->header('User-Agent')
        ));

        session()->regenerate();

        // TODO! send notification email about the sign in IP, and browser

        return redirect()->route('dashboard');
    }
}
