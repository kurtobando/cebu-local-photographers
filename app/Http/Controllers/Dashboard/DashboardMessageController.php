<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageThread;
use App\Services\MessageService;
use Inertia\Response;

class DashboardMessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
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
                ]), [
                    'is_unread' => $this->messageService->isMessageHasUnreadThreadByUserId(auth()->id(), $message->uuid),
                ]);
            })
        ]);
    }

    public function show(string $uuid): Response
    {
        $message = $this->messageService->getMessageByUuid($uuid);
        $messageThread = $this->messageService->getMessageThreadByUuid($uuid);

        return inertia('Dashboard/TheDashboardMessageShow', [
            'message_uuid' => $uuid,
            'message_user_id_receiver' => $message
                ->filter(fn (Message $item) => $item->user_id !== auth()->id())
                ->first()
                ->user_id,
            'messages_thread' => $messageThread->map(function (MessageThread $thread) {
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
            }),
            'message_thread_mark_as_read' => $this->messageService->markMessageThreadReadByUuid($uuid, auth()->id()),
        ]);
    }
}
