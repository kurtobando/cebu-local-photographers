<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSaveForLaterRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;

class PostSaveForLaterController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
        //
    }

    public function store(PostSaveForLaterRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            $this->postService->savePostForLater($request->post_id, auth()->id());
        }

        // TODO! if not signed in, redirect to login page or a modal component

        return redirect()
            ->back()
            ->with(['success' => 'Post saved for later']);
    }
}
