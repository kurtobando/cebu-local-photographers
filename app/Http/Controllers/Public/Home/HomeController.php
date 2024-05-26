<?php

namespace App\Http\Controllers\Public\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Inertia\Response;

class HomeController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    public function index(): Response
    {
        $posts = $this->postService->getPosts()->map(function (Post $post) {
            return array_merge($post->toArray(), [
                'category' => $post->category->name,
                'media' => $post->getMediaThumbnails(),
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'avatar' => $post->user->getAvatar(),
                ],
            ]);
        });

        return inertia('TheHome', [
            'posts' => $posts,
        ]);
    }
}
