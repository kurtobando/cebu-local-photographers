<?php

namespace App\Http\Controllers\Protected\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardProfileImageRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardProfileImageController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function store(DashboardProfileImageRequest $request): RedirectResponse
    {
        try {
            $this->userService->updateProfileImageByUserId(auth()->id(), $request->file);

            return redirect()
                ->route('dashboard.profile.index')
                ->with(['success' => 'Profile image uploaded successfully.']);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            return redirect()
                ->route('dashboard.profile.index')
                ->with(['error' => $e->getMessage()]);
        }
    }
}
