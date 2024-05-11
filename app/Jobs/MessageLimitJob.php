<?php

namespace App\Jobs;

use App\Models\MessageLimit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageLimitJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly MessageLimit $messageLimit
    ) {
    }

    public function handle(): void
    {
        $this
            ->messageLimit
            ->update([
                'limit' => MessageLimit::DEFAULT_LIMIT
            ]);
    }
}
