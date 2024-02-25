<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('staff:clockout')->everyFiveMinutes();
        $schedule->command('staff:updatetime')->everyMinute();
        $schedule->command('staff:synctow')->everyMinute();
        $schedule->command("discord:sync")->hourly();
        $schedule->command("opfw:sync-avatar")->everyTwoHours();
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
