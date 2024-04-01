<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\CategoryStatusEnum;
use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardPhotosStoreRequest;
use App\Http\Requests\DashboardPhotosUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardPhotosController extends Controller
{
    public function __construct(
        private readonly Category $category,
        private readonly Post     $post
    ) {
        //
    }

    public function create()
    {
        return inertia('Dashboard/TheDashboardPhotosCreate');
    }

    public function store(DashboardPhotosStoreRequest $request)
    {
        try {
            $post = $this->post->create([
                'user_id' => auth()->user()->id,
                'status' => PostStatusEnum::DRAFT->value,
                'title' => '',
                'description' => '',
                'tag' => '',
                'category_id' => 1,
                'comments' => 0,
                'views' => 0,
                'likes' => 0,
            ]);

            $media = $this->post->find($post->id);
            $media->addMedia($request->file)->toMediaCollection('photos');

            return redirect()->route('dashboard.photos.show', ['post' => $post->id]);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            return redirect()
                ->route('dashboard.photos.create')
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function show(Post $post)
    {
        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        $media = $post->getFirstMedia('photos')->getFullUrl('large');
        $categories = $this->category->where('status', CategoryStatusEnum::PUBLISHED->value)->get(['id', 'name']);

        return inertia('Dashboard/TheDashboardPhotosShow', [
            'post' => $post,
            'media' => $media,
            'categories' => $categories,
        ]);
    }

    public function update(DashboardPhotosUpdateRequest $request)
    {
        dd($request->all());

        if (request()->user()->cannot('update', $request->id)) {
            abort(403);
        }
    }
}
