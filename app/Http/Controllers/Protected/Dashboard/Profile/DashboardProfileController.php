<?php

namespace App\Http\Controllers\Protected\Dashboard\Profile;

use App\Enums\UserAuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardProfileUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class DashboardProfileController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function index(): Response
    {
        return inertia('Dashboard/TheDashboardProfile');
    }

    public function update(DashboardProfileUpdateRequest $request): RedirectResponse
    {
        if (
            $request->provider === UserAuthProviderEnum::DEFAULT->value &&
            $request->is_change_password
        ) {
            $this->userService->updatePasswordByUserId(auth()->id(), $request->password);
        }

        $this->userService->updateProfileByUserId(auth()->id(), $request->validated());

        return redirect()
            ->route('dashboard.profile.index')
            ->with(['success' => 'Profile updated successfully.']);
    }
}
