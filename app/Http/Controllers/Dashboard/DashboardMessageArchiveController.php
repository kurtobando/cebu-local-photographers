<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;

class DashboardMessageArchiveController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
        //
    }

    public function update(string $uuid): RedirectResponse
    {
        $this->messageService->markMessageAsArchivedByUuid($uuid, auth()->id());

        return redirect()->route('dashboard.message.index');
    }
}
