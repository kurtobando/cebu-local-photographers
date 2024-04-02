<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardPhotosStoreRequest;
use App\Http\Requests\DashboardPhotosUpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardPhotosController extends Controller
{
    public function __construct(
        private readonly PostService $postService
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
            $post = $this->postService->savePost();
            $post->addMedia($request->file)->toMediaCollection('photos');

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

        return inertia('Dashboard/TheDashboardPhotosShow', [
            'post' => $post,
            'media' => $post->getFirstMedia('photos')->getFullUrl('large'),
            'categories' => $this->postService->getPostCategories(),
        ]);
    }

    public function update(DashboardPhotosUpdateRequest $request)
    {
        $post = $this->postService->getPostById($request->id);

        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        $this->postService->updatePostById($request->id, $request->validated());

        // TODO! redirect to news feed, or manage photos page

        return redirect()
            ->back()
            ->with(['success' => 'Your post has been successfully saved.']);
    }
}
