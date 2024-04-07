<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
        //
    }

    public function index(Request $request): Response
    {
        if (!$this->postService->isPostPublished($request->id) &&
            !$this->postService->isPostAuthorCurrentUser($request->id)
        ) {
            abort(ResponseAlias::HTTP_NOT_FOUND);
        }

        $this->postService->incrementPostViews($request->id);
        $post = $this->postService->getPostById($request->id);
        $postAuthor = $this->postService->getAuthorByUserId($post->user_id);

        return inertia('ThePost', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'category' => $post->category->name,
                'tags' => $post->tags,
                'status' => $post->status,
                'media' => $post->getMediaThumbnails(),
                'comments' => $post->comments,
                'likes' => $post->likes,
                'views' => $post->views,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user_id' => $post->user_id,
                'post_category_id' => $post->post_category_id,
            ],
            'post_author' => [
                'id' => $postAuthor->id,
                'name' => $postAuthor->name,
                'email' => $postAuthor->email,
                'role' => $postAuthor->role,
                'about' => $postAuthor->about,
                'avatar' => $postAuthor->getAvatar(),
            ],
            'post_is_like' => $this->postService->isPostLikedByCurrentUser($request->id, auth()->id()),
        ]);
    }
}
