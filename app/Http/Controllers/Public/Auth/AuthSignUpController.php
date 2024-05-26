<?php

namespace App\Http\Controllers\Public\Auth;

use App\Enums\UserAuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthSignUpRequest;
use App\Services\SignUpService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class AuthSignUpController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService
    ) {
    }

    public function index(): Response
    {
        return inertia('TheSignUp');
    }

    public function store(AuthSignUpRequest $request): RedirectResponse
    {
        $user = $this->signUpService->signUp($request->all(), UserAuthProviderEnum::DEFAULT->value);

        auth()->loginUsingId($user->id);

        session()->regenerate();

        return redirect()->route('dashboard');
    }
}
