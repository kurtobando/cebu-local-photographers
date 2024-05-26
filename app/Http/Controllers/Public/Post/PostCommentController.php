<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCommentRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;

class PostCommentController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    public function store(PostCommentRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            $this->postService->savePostCommentByPostId($request->post_id, $request->user()->id, $request->comment);
            $this->postService->incrementPostCommentCount($request->post_id);
            // TODO! add notification to post author
        }

        return redirect()
            ->back()
            ->with(['success' => 'Comment posted successfully.']);
    }
}
