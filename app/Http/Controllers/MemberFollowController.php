<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserFollowerService;
use Illuminate\Http\RedirectResponse;

class MemberFollowController extends Controller
{
    public function __construct(
        private readonly UserFollowerService $userFollowerService
    ) {
    }

    public function store(User $user): RedirectResponse
    {
        if (auth()->check()) {
            $this->userFollowerService->saveFollowerUserByUserId($user->id, auth()->id());
        }

        return redirect()
            ->back()
            ->with(['success' => 'You are now following '.$user->name.'.']);
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->check()) {
            $this->userFollowerService->deleteFollowerUserByUserId($user->id, auth()->id());
        }

        return redirect()
            ->back()
            ->with(['success' => 'You are no longer following '.$user->name.'.']);
    }
}
