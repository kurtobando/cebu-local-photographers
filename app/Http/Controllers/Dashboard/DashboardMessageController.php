<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardMessageRequest;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class DashboardMessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
        //
    }

    public function store(DashboardMessageRequest $request): RedirectResponse
    {
        $messageUuId = Str::uuid()->toString();
        $message = $request->message;
        $messageUserIdSender = auth()->id();
        $messageUserIdReceiver = $request->user_id_receiver;

        if ($this->messageService->isMessageLimitReachedByUserId($messageUserIdSender)) {
            return redirect()
                ->back()
                ->with(['error' => 'You have reached the message limit for this month']);
        }

        $this->messageService->decreaseMessageLimitByUserId($messageUserIdSender);
        $this->messageService->saveMessage($messageUuId, $message, $messageUserIdSender);
        $this->messageService->saveMessage($messageUuId, $message, $messageUserIdReceiver);
        $this->messageService->saveMessageThread($messageUuId, $messageUserIdSender, $messageUserIdReceiver, $message);

        // TODO! send notification via email for newly created message, only once

        return redirect()
            ->back()
            ->with(['success' => 'Your message has been successfully sent']);
    }
}
