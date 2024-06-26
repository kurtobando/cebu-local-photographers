<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use App\Services\PostService;
use App\Services\UserFollowerService;
use Illuminate\Http\Request;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService,
        private readonly UserFollowerService $userFollowerService
    ) {
    }

    public function index(Request $request): Response
    {
        if (!$this->postService->isPostPublished($request->id) &&
            !$this->postService->isPostAuthorCurrentUser($request->id, auth()->id())
        ) {
            abort(ResponseAlias::HTTP_NOT_FOUND);
        }

        $this->postService->incrementPostViews($request->id);
        $post = $this->postService->getPostById($request->id);
        $postComments = $this->postService->getPostCommentsByPostId($request->id);

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
                'id' => $post->user->id,
                'name' => $post->user->name,
                'email' => $post->user->email,
                'role' => $post->user->role,
                'about' => $post->user->about,
                'avatar' => $post->user->getAvatar(),
            ],
            'post_author_is_followed' => $this->userFollowerService->isCurrentUserFollower($post->user->id, auth()->id()),
            'post_comments' => $postComments->map(function (PostComment $comment) {
                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at,
                    'updated_at' => $comment->updated_at,
                    'likes' => $comment->likes,
                    'views' => $comment->views,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                        'avatar' => $comment->user->getAvatar(),
                    ],
                    'comment_is_like' => $this->postService->isPostCommentLikedByCurrentUser($comment->id, auth()->id()),
                ];
            }),
            'post_is_like' => $this->postService->isPostLikedByCurrentUser($request->id, auth()->id()),
        ]);
    }
}
