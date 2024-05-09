<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'app' => [
                'name' => config('app.name'),
                'url' => config('app.url'),
            ],
            'auth' => [
                'user' => $request->user()?->only([
                    'id',
                    'name',
                    'email',
                    'avatar',
                    'provider',
                    'role',
                    'about',
                    'message_limit'
                ]),
                'notification' => [
                    'unread_count' => $request->user()?->unreadNotifications()->count(),
                    'unread' => $request->user()?->unreadNotifications()->get(),
                ],
                'can' => [
                    'store' => [
                        'post' => $request->user()?->can('store post'),
                        'comment' => $request->user()?->can('store comment'),
                        'follow' => $request->user()?->can('store follow'),
                        'like' => $request->user()?->can('store like'),
                        'save_later' => $request->user()?->can('store save-later'),
                        'event' => $request->user()?->can('store event'),
                        'event_attendee' => $request->user()?->can('store event-attendee'),
                        'user' => $request->user()?->can('store user'),
                        'user_profile' => $request->user()?->can('store user-profile'),
                    ],
                    'update' => [
                        'post' => $request->user()?->can('update post'),
                        'comment' => $request->user()?->can('update comment'),
                        'follow' => $request->user()?->can('update follow'),
                        'like' => $request->user()?->can('update like'),
                        'save_later' => $request->user()?->can('update save-later'),
                        'event' => $request->user()?->can('update event'),
                        'event_attendee' => $request->user()?->can('update event-attendee'),
                        'user' => $request->user()?->can('update user'),
                        'user_profile' => $request->user()?->can('update user-profile'),
                    ],
                    'delete' => [
                        'post' => $request->user()?->can('delete post'),
                        'comment' => $request->user()?->can('delete comment'),
                        'follow' => $request->user()?->can('delete follow'),
                        'like' => $request->user()?->can('delete like'),
                        'save_later' => $request->user()?->can('delete save-later'),
                        'event' => $request->user()?->can('delete event'),
                        'event_attendee' => $request->user()?->can('delete event-attendee'),
                        'user' => $request->user()?->can('delete user'),
                        'user_profile' => $request->user()?->can('delete user-profile'),
                    ]
                ]
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'warning' => fn () => $request->session()->get('warning'),
                'info' => fn () => $request->session()->get('info'),
            ],
        ]);
    }
}
