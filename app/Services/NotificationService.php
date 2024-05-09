<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class NotificationService
{
    public function __construct()
    {
        //
    }

    public function markUnreadNotificationById(string $id): int
    {
        return DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => now()]);
    }
}
