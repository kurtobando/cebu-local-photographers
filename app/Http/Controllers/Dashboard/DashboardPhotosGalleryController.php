<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Inertia\Response;

class DashboardPhotosGalleryController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
        //
    }

    public function index(): Response
    {
        $posts = $this->postService->getPostsByUserId(auth()->id());
        $postAuthor = $this->postService->getAuthorByUserId(auth()->id());

        return inertia('Dashboard/TheDashboardPhotosGalleryIndex', [
            'posts' => $posts->map(function (Post $post) {
                return array_merge($post->toArray(), [
                    'category' => $post->category->name,
                    'media' => $post->getMediaThumbnails(),
                ]);
            }),
            'post_author' => $postAuthor,
        ]);
    }
}
