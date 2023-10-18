<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardPhotosRequest;
use App\Models\Post;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardPhotosController extends Controller
{
    public function create()
    {
        return inertia('Dashboard/TheDashboardPhotos');
    }

    public function store(DashboardPhotosRequest $request)
    {
        try {
            $post = Post::create([
                'user_id' => auth()->user()->id,
                'status' => PostStatusEnum::PUBLISHED->value,
                'title' => 'hello world',
                'description' => 'hello world',
                'tag' => '#helloworld',
                'category_id' => 1,
                'comments' => 0,
                'views' => 0,
                'likes' => 0,
            ]);

            $media = Post::find($post->id);
            $media = $media->addMedia($request->file)->toMediaCollection('photos');

            ray($media->getFullUrl('thumbnail'));

            return redirect()
                ->route('dashboard.photos.create')
                ->with(['success' => 'Photo uploaded successfully!']);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            return redirect()
                ->route('dashboard.photos.create')
                ->with(['error' => $e->getMessage()]);
        }
    }
}
