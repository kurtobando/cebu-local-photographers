<?php

namespace App\Http\Controllers\Protected\Dashboard\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardPhotosStoreRequest;
use App\Http\Requests\DashboardPhotosUpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardPhotosController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    public function create(): Response
    {
        return inertia('Dashboard/TheDashboardPhotosCreate');
    }

    public function store(DashboardPhotosStoreRequest $request): RedirectResponse
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

    public function show(Post $post): Response
    {
        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        return inertia('Dashboard/TheDashboardPhotosShow', [
            'post' => array_merge($post->toArray(), [
                'category' => $post->category->name,
                'media' => $post->getMediaThumbnails(),
            ]),
            'categories' => $this->postService
                ->getPostCategories()
                ->map(function ($item) {
                    return $item->only(['id', 'name']);
                }),
        ]);
    }

    public function edit(Post $post): Response
    {
        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        return inertia('Dashboard/TheDashboardPhotosEdit', [
            'post' => array_merge($post->toArray(), [
                'category' => $post->category->name,
                'media' => $post->getMediaThumbnails(),
            ]),
            'categories' => $this->postService
                ->getPostCategories()
                ->map(function ($item) {
                    return $item->only(['id', 'name']);
                }),
        ]);
    }

    public function update(DashboardPhotosUpdateRequest $request): RedirectResponse
    {
        $post = $this->postService->getPostById($request->id);

        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        $this->postService->updatePostById($request->id, $request->validated());

        return redirect()->route('dashboard.photos-gallery.index');
    }
}
