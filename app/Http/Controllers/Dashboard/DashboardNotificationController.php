<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class DashboardNotificationController extends Controller
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {
    }

    public function index(): Response
    {
        return inertia('Dashboard/TheDashboardNotification', [
            'notification_unread' => auth()->user()->unreadNotifications()->get(),
        ]);
    }

    public function update(string $uuid): RedirectResponse
    {
        $this->notificationService->markUnreadNotificationById($uuid);

        return redirect()
            ->back()
            ->with(['success' => 'Notification marked as read.']);
    }
}
