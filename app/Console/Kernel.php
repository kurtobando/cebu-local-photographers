<?php

namespace App\Console;

use App\Jobs\MessageLimitJob;
use App\Jobs\SitemapJob;
use App\Models\MessageLimit;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('telescope:prune --hours=48')->daily();
        $schedule->job(new MessageLimitJob(new MessageLimit()))->monthly()->at('01:00');
        $schedule->job(new SitemapJob())->daily()->at('06:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
