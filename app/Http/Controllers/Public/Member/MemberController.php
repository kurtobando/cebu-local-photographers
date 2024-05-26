<?php

namespace App\Http\Controllers\Public\Member;

use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use App\Services\UserFollowerService;
use App\Services\UserService;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MemberController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly UserFollowerService $userFollowerService,
        private readonly PostService $postService
    ) {
    }

    public function index(): Response
    {
        return inertia('TheMembers', [
            'users' => $this->userService->getUsersInRandomOrder(),
        ]);
    }

    // TODO! show slug + user id {id}?name={name}
    public function show(User $user): Response
    {
        if (!$this->userService->isUserActive($user->id)) {
            abort(ResponseAlias::HTTP_NOT_FOUND);
        }

        $posts = $this->postService->getPostsByUserId($user->id);

        return inertia('TheMembersShow', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'about' => $user->about,
                'avatar' => $user->getAvatar(),
                'role' => $user->role,
            ],
            'user_follower_count' => $this->userFollowerService->getFollowerCountByUserId($user->id),
            'user_is_followed' => $this->userFollowerService->isCurrentUserFollower($user->id, auth()->id()),
            'posts_count' => $posts
                ->filter(fn (Post $post) => $post->status === PostStatusEnum::PUBLISHED->value)
                ->count(),
            'posts' => $posts
                ->filter(fn (Post $post) => $post->status === PostStatusEnum::PUBLISHED->value)
                ->map(function (Post $post) {
                    return array_merge($post->toArray(), [
                        'category' => $post->category->name,
                        'media' => $post->getMediaThumbnails(),
                        'user' => $post->user->only(['id', 'name', 'avatar']),
                    ]);
                }),
        ]);
    }
}
