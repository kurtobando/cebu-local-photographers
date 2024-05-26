<?php

namespace App\Services;

use App\Enums\CategoryStatusEnum;
use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use App\Models\PostSaveForLater;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostService
{
    public function __construct(
        private readonly Post $post,
        private readonly PostCategory $postCategory,
        private readonly PostLike $postLike,
        private readonly PostSaveForLater $postSaveForLater,
        private readonly PostComment $postComment,
        private readonly PostCommentLike $postCommentLike,
        private readonly User $user
    ) {
    }

    public function getPosts(): Collection
    {
        return $this
            ->post
            ->with(['category', 'media', 'user'])
            ->where('status', PostStatusEnum::PUBLISHED->value)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getPostById(int $id): Post
    {
        return $this
            ->post
            ->where('id', $id)
            ->first();
    }

    public function getPostsByUserId(int $id): Collection
    {
        return $this
            ->post
            ->with(['category', 'media', 'user'])
            ->where(['user_id' => $id])
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getPostAuthorByUserId(int $id): User
    {
        return $this
            ->user
            ->where('id', $id)
            ->first();
    }

    public function getPostCategories(): Collection
    {
        return $this
            ->postCategory
            ->where('status', CategoryStatusEnum::PUBLISHED->value)
            ->get();
    }

    public function getPostCommentsByPostId(int $id): Collection
    {
        return $this
            ->postComment
            ->where('post_id', $id)
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function savePost(UploadedFile $file): Post
    {
        $post = $this->post->create([
            'user_id' => auth()->user()->id,
            'status' => PostStatusEnum::DRAFT->value,
            'title' => '',
            'description' => '',
            'tags' => '',
            'post_category_id' => PostCategory::first()->id,
            'comments' => 0,
            'views' => 0,
            'likes' => 0,
        ]);

        $post->addMedia($file)->toMediaCollection('photos');

        return $post;
    }

    public function savePostLike(int $postId, int $userId): PostLike
    {
        return $this->postLike->updateOrCreate([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);
    }

    public function savePostForLater(int $postId, int $userId): PostSaveForLater
    {
        return $this->postSaveForLater->updateOrCreate([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);
    }

    public function savePostCommentByPostId(int $postId, int $userId, string $comment): PostComment
    {
        return $this->postComment->create([
            'post_id' => $postId,
            'user_id' => $userId,
            'comment' => $comment,
            'status' => PostStatusEnum::PUBLISHED->value,
            'views' => 0,
            'likes' => 0,
        ]);
    }

    public function savePostCommentLike(int $postId, int $commentId, int $userId): PostCommentLike
    {
        return $this->postCommentLike->updateOrCreate([
            'post_id' => $postId,
            'post_comment_id' => $commentId,
            'user_id' => $userId,
        ]);
    }

    public function updatePostById(int $id, array $data): Post
    {
        $post = $this->getPostById($id);

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->tags = $data['tags'];
        $post->post_category_id = $data['post_category_id'];
        $post->status = PostStatusEnum::PUBLISHED->value;
        $post->save();

        return $post;
    }

    public function deletePostLike(int $postId, int $userId): ?bool
    {
        return $this
            ->postLike
            ->where('post_id', $postId)
            ->where('user_id', $userId)
            ->delete();
    }

    public function deletePostCommentLike(int $postId, int $commentId, int $userId): ?bool
    {
        return $this
            ->postCommentLike
            ->where('post_id', $postId)
            ->where('post_comment_id', $commentId)
            ->where('user_id', $userId)
            ->delete();
    }

    public function isPostPublished(int $postId): bool
    {
        return $this
            ->post
            ->where('id', $postId)
            ->where('status', PostStatusEnum::PUBLISHED->value)
            ->exists();
    }

    public function isPostAuthorCurrentUser(int $postId, int $userId): bool
    {
        return $this
            ->post
            ->where('id', $postId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function isPostLikedByCurrentUser(int $postId, ?int $userId): bool
    {
        if (is_null($userId)) {
            return false;
        }

        return $this
            ->postLike
            ->where('post_id', $postId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function isPostCommentLikedByCurrentUser(int $commentId, ?int $userId): bool
    {
        if (is_null($userId)) {
            return false;
        }

        return $this
            ->postCommentLike
            ->where('post_comment_id', $commentId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function incrementPostViews(int $postId): void
    {
        Post::withoutTimestamps(function () use ($postId) {
            // TODO! lets increment only once per IP/session
            $this->post->where('id', $postId)->increment('views');
        });
    }

    public function incrementPostCommentCount(int $postId): void
    {
        Post::withoutTimestamps(function () use ($postId) {
            $count = $this->postComment->where('post_id', $postId)->count();

            $post = $this->post->where('id', $postId)->first();
            $post->comments = $count;
            $post->save();
        });
    }

    public function incrementLikeCount(int $postId): void
    {
        Post::withoutTimestamps(function () use ($postId) {
            $count = $this->postLike->where('post_id', $postId)->count();

            $post = $this->post->where('id', $postId)->first();
            $post->likes = $count;
            $post->save();
        });
    }

    public function incrementLikeCommentCount(int $commentId): void
    {
        PostComment::withoutTimestamps(function () use ($commentId) {
            $count = $this->postCommentLike->where('post_comment_id', $commentId)->count();

            $comment = $this->postComment->where('id', $commentId)->first();
            $comment->likes = $count;
            $comment->save();
        });
    }

    public function decrementLikeCount(int $postId): void
    {
        Post::withoutTimestamps(function () use ($postId) {
            $count = $this->postLike->where('post_id', $postId)->count();

            $post = $this->post->where('id', $postId)->first();
            $post->likes = $count;
            $post->save();
        });
    }

    public function decrementLikeCommentCount(int $commentId): void
    {
        PostComment::withoutTimestamps(function () use ($commentId) {
            $count = $this->postCommentLike->where('post_comment_id', $commentId)->count();

            $comment = $this->postComment->where('id', $commentId)->first();
            $comment->likes = $count;
            $comment->save();
        });
    }

}
