<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardProfileImageRequest;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardProfileImageController extends Controller
{
    public function store(DashboardProfileImageRequest $request)
    {
        try {
            $user = User::findOrFail(auth()->id());
            $user->avatar = $user->addMedia($request->file)->toMediaCollection('avatar')->getFullUrl('thumbnail');
            $user->save();

            return redirect()
                ->route('dashboard.profile')
                ->with(['success' => 'Profile image uploaded successfully.']);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            return redirect()
                ->route('dashboard.profile')
                ->with(['error' => $e->getMessage()]);
        }
    }
}
