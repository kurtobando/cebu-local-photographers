<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUnlikeRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;

class PostUnlikeController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
        //
    }

    public function store(PostUnlikeRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            $this->postService->deletePostLike($request->post_id, auth()->id());
            $this->postService->decrementLikeCount($request->post_id);
        }

        // TODO! if not signed in, redirect to login page or a modal component

        return redirect()
            ->back()
            ->with(['success' => 'Post unliked successfully']);
    }
}
