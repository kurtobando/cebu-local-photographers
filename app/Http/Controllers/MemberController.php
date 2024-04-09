<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MemberController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
        //
    }

    public function index(): Response
    {
        return inertia('TheMembers', [
            'users' => $this->userService->getUsers()
        ]);
    }

    public function show(User $user): Response
    {
        if (!$this->userService->isUserActive($user->id)) {
            abort(ResponseAlias::HTTP_NOT_FOUND);
        }

        return inertia('TheMembersShow', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'about' => $user->about,
                'avatar' => $user->getAvatar(),
            ]
        ]);
    }
}
