<?php

namespace App\Console;

use App\Jobs\NotifyClient;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

//        $schedule->job(new NotifyClient($client))->cron('0 0 */3 * *');
//        $schedule->job(new NotifyClient)->cron('0 0 */3 * *');
        $schedule->job(new NotifyClient)->cron('* * * * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
