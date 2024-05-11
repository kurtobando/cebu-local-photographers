<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardMessageRequest;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Response;

class HireMeMessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {
    }

    public function index(): Response
    {
        return inertia('Dashboard/TheDashboardMessage');
    }

    public function store(DashboardMessageRequest $request): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()
                ->back()
                ->with(['error' => 'You need to sign-in to send a message']);
        }

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
        $this->messageService->notifyNewMessageByUserId($messageUserIdReceiver, $messageUuId);

        return redirect()
            ->back()
            ->with(['success' => 'Your message has been successfully sent']);
    }
}
