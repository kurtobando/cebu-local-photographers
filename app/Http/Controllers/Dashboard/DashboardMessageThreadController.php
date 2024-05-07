<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardMessageThreadRequest;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;

class DashboardMessageThreadController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
        //
    }

    public function store(DashboardMessageThreadRequest $request, string $uuid): RedirectResponse
    {
        $this->messageService->saveMessageThread(
            $uuid,
            auth()->id(),
            $request->message_user_id_receiver,
            $request->message
        );

        return redirect()
            ->back()
            ->with(['success' => 'Message sent successfully.']);
    }
}
