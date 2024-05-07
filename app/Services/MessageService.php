<?php

namespace App\Services;

use App\Models\Message;
use App\Models\MessageLimit;
use App\Models\MessageThread;
use App\Models\User;
use App\Notifications\MessageNewNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MessageService
{
    public function __construct(
        private readonly User $user,
        private readonly Message $message,
        private readonly MessageThread $messageThread,
        private readonly MessageLimit $messageLimit
    ) {
        //
    }


    public function getMessagesByUserId(int $id): Collection
    {
        return $this->message
            ->with(['user'])
            ->where('user_id', $id)
            ->whereNot('is_archived', true)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getMessageByUuid(string $uuid): Collection
    {
        return $this
            ->message
            ->where('uuid', $uuid)
            ->get();
    }

    public function getMessageThreadByUuid(string $uuid): Collection
    {
        return $this
            ->messageThread
            ->with(['receiver', 'sender'])
            ->where('uuid', $uuid)
            ->orderByDesc('created_at')
            ->get();
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

    public function markMessageAsArchivedById(
        int $messageId,
        int $userId
    ): int {
        return $this
            ->message
            ->where('id', $messageId)
            ->where('user_id', $userId)
            ->update([
                'is_archived' => true
            ]);
    }

    public function markMessageAsArchivedByUuid(
        string $uuid,
        int $userId
    ): int {
        return $this
            ->message
            ->where('uuid', $uuid)
            ->where('user_id', $userId)
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

    public function markMessageThreadReadByUuid(
        string $messageUuid,
        int $userId
    ): int {
        return $this
            ->messageThread
            ->where('uuid', $messageUuid)
            ->where('user_id_receiver', $userId)
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

    public function isMessageHasUnreadThreadByUserId(
        int $id,
        string $messageUuid
    ): bool {
        return $this
            ->messageThread
            ->where('uuid', $messageUuid)
            ->where('user_id_receiver', $id)
            ->where('is_read', false)
            ->exists();
    }

    public function isMessageLimitReachedByUserId(int $id): bool
    {
        return $this
            ->messageLimit
            ->where('user_id', $id)
            ->where('limit', 0)
            ->exists();
    }

    public function notifyNewMessageByUserId(
        int $id,
        string $messageUuId
    ): void {
        $this
            ->user
            ->where('id', $id)
            ->first()
            ->notify(new MessageNewNotification($messageUuId));
    }

}
