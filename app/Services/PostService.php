<?php

namespace App\Services;

use App\Enums\CategoryStatusEnum;
use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLike;
use App\Models\PostSaveForLater;
use App\Models\User;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        private readonly Post         $post,
        private readonly PostCategory $postCategory,
        private readonly PostLike     $postLike,
        private readonly PostSaveForLater $postSaveForLater,
        private readonly User         $user
    ) {
        //
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
            ->with(['category', 'media'])
            ->where(['user_id' => $id])
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getAuthorByUserId(int $id): User
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

    public function savePost(): Post
    {
        return $this->post->create([
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

    public function isPostPublished(int $id): bool
    {
        return $this
            ->post
            ->where('id', $id)
            ->where('status', PostStatusEnum::PUBLISHED->value)
            ->exists();
    }

    public function isPostAuthorCurrentUser(int $id): bool
    {
        return $this
            ->post
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function isPostLikedByCurrentUser(int $id, int|null $userId): bool
    {
        if (is_null($userId)) {
            return false;
        }

        return $this
            ->postLike
            ->where('post_id', $id)
            ->where('user_id', $userId)
            ->exists();
    }

    public function incrementPostViews(int $id): void
    {
        Post::withoutTimestamps(function () use ($id) {
            // TODO! lets increment only once per IP/session
            $this->post->where('id', $id)->increment('views');
        });
    }

    public function incrementLikeCount(int $id): void
    {
        Post::withoutTimestamps(function () use ($id) {
            $count = $this->postLike->where('post_id', $id)->count();

            $post = $this->post->where('id', $id)->first();
            $post->likes = $count;
            $post->save();
        });
    }

    public function decrementLikeCount(mixed $post_id): void
    {
        Post::withoutTimestamps(function () use ($post_id) {
            $count = $this->postLike->where('post_id', $post_id)->count();

            $post = $this->post->where('id', $post_id)->first();
            $post->likes = $count;
            $post->save();
        });
    }
}
