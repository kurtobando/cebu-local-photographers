<?php

namespace App\Services;

use App\Enums\CategoryStatusEnum;
use App\Enums\PostStatusEnum;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        private readonly Post $post,
        private readonly Category $category,
        private readonly User $user
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
            ->latest()
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
            ->category
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
            'category_id' => Category::first()->id,
            'comments' => 0,
            'views' => 0,
            'likes' => 0,
        ]);
    }

    public function updatePostById(int $id, array $data): Post
    {
        $post = $this->getPostById($id);

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->tags = $data['tags'];
        $post->category_id = $data['category_id'];
        $post->status = PostStatusEnum::PUBLISHED->value;
        $post->save();

        return $post;
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
}
