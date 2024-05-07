<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageThread;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class DashboardMessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
        //
    }

    public function index(): Response
    {
        $messages = $this->messageService->getMessagesByUserId(auth()->id());

        return inertia('Dashboard/TheDashboardMessage', [
            'messages' => $messages->map(function (Message $message) {
                return array_merge($message->only([
                    'id',
                    'uuid',
                    'updated_at',
                    'created_at',
                    'subject'
                ]));
            })
        ]);
    }

    public function show(string $uuid): Response
    {
        $messages = $this->messageService->getMessageThreadByUuid($uuid);

        return inertia('Dashboard/TheDashboardMessageShow', [
            'message_uuid' => $uuid,
            'messages_thread' => $messages->map(function (MessageThread $thread) {
                return array_merge($thread->only([
                    'id',
                    'uuid',
                    'is_read',
                    'message',
                    'created_at',
                    'updated_at'
                ]), [
                    'sender' => $thread->sender->only(['id', 'name', 'email']),
                    'receiver' => $thread->receiver->only(['id', 'name', 'email']),
                ]);
            })
        ]);
    }

    public function update(string $uuid): RedirectResponse
    {
        $this->messageService->markMessageAsArchivedByUuid($uuid, auth()->id());

        return redirect()->route('dashboard.message.index');
    }
}
