<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UserAuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Response;

class DashboardProfileController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    public function index(): Response
    {
        return inertia('Dashboard/TheDashboardProfile');
    }

    public function update(DashboardProfileUpdateRequest $request): RedirectResponse
    {
        $user = $this->user->where('id', auth()->id())->firstOrFail();
        $user->name = $request->name;
        $user->about = $request->about;
        $user->save();

        if ($request->provider === UserAuthProviderEnum::DEFAULT->value) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()
            ->route('dashboard.profile')
            ->with(['success' => 'Profile updated successfully.']);
    }
}
