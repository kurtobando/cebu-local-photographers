<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentLikeRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;

class PostCommentLikeController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    public function store(PostCommentLikeRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            $this->postService->savePostCommentLike($request->post_id, $request->comment_id, auth()->id());
            $this->postService->incrementLikeCommentCount($request->comment_id);
        }

        return redirect()
            ->back()
            ->with(['success' => 'Comment liked!']);
    }

    public function destroy(PostCommentLikeRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            $this->postService->deletePostCommentLike($request->post_id, $request->comment_id, auth()->id());
            $this->postService->decrementLikeCommentCount($request->comment_id);
        }

        return redirect()
            ->back()
            ->with(['success' => 'Comment unliked!']);
    }
}
