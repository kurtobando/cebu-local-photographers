<?php

namespace App\Http\Controllers\Protected\Dashboard\Profile;

use App\Enums\UserAuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Response;

class DashboardProfileController extends Controller
{
    public function __construct(
        private readonly User $user
    ) {
    }

    public function index(): Response
    {
        return inertia('Dashboard/TheDashboardProfile');
    }

    public function update(DashboardProfileUpdateRequest $request): RedirectResponse
    {
        $user = $this->user->where('id', auth()->id())->firstOrFail();

        if ($request->provider === UserAuthProviderEnum::DEFAULT->value && $request->is_change_password) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->about = $request->about;
        $user->save();

        return redirect()
            ->route('dashboard.profile.index')
            ->with(['success' => 'Profile updated successfully.']);
    }
}
