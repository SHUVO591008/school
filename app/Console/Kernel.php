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
        Commands\DemoCron::class,
        'App\Console\Commands\cronEmail'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     $test = DB::table('costs')->where('id',4)->delete();
        // })->everyMinute();

        // $schedule->command('demo:cron')
        // ->everyMinute();

        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');

        //$schedule->command('backup:clean')->daily()->at('01:00');

        $schedule->command('notify:email')
                ->daily()->at('10:05');



    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
