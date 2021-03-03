<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\NotificationCron::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:weekly')
            ->weekly()
            ->sundays()
            ->at('20:00')
            ->timezone('Asia/Ho_Chi_Minh')
            ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
