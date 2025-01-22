<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\FetchSocialMediaData::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run the command every hour
        $schedule->command('fetch:social-media')->hourly();

        // Alternatively, you could schedule the command to run at a specific time
        // $schedule->command('fetch:social-media')->dailyAt('00:00');

        // Additional command scheduling if necessary
        $schedule->command('fetch:social-media-data')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
