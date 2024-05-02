<?php

namespace App\Services;

use App\Models\Message;
use App\Models\MessageLimit;
use App\Models\MessageThread;
use Illuminate\Support\Str;

class MessageService
{
    public function __construct(
        private readonly Message $message,
        private readonly MessageThread $messageThread,
        private readonly MessageLimit $messageLimit
    ) {
        //
    }

    public function saveMessage(
        string $uuid,
        string $subject,
        int $userId,
    ): Message {
        return $this->message->create([
            'uuid' => $uuid,
            'subject' => Str::limit($subject, 60),
            'user_id' => $userId,
            'is_archived' => false
        ]);
    }

    public function saveMessageThread(
        string $uuid,
        int $userIdSender,
        int $userIdReceiver,
        string $message,
    ): MessageThread {
        return $this->messageThread->create([
            'uuid' => $uuid,
            'user_id_sender' => $userIdSender,
            'user_id_receiver' => $userIdReceiver,
            'message' => $message,
            'is_read' => false
        ]);
    }

    public function markMessageAsArchivedById(int $messageId): int
    {
        return $this
            ->message
            ->where('id', $messageId)
            ->update([
                'is_archived' => true
            ]);
    }

    public function markMessageThreadReadById(int $messageThreadId): int
    {
        return $this
            ->messageThread
            ->where('id', $messageThreadId)
            ->update([
                'is_read' => true
            ]);
    }

    public function decreaseMessageLimitByUserId(int $id): int
    {
        return $this
            ->messageLimit
            ->where('user_id', $id)
            ->decrement('limit');
    }

    public function isMessageLimitReachedByUserId(int $id): bool
    {
        return $this
            ->messageLimit
            ->where('user_id', $id)
            ->where('limit', 0)
            ->exists();
    }
}
