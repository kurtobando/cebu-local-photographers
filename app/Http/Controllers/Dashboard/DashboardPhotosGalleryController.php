<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        $post = $this->postService->getPostsByUserId(auth()->id());

        return inertia('Dashboard/TheDashboardPhotosGalleryIndex', [
            'posts' => $post,
        ]);
    }
}