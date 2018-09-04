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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->call('App\Http\Controllers\NotificacionQuincenalController@enviarCorreo')->cron('00 00 15 * *'); //descomentar para salida oficial

        //$schedule->call('App\Http\Controllers\NotificacionCiudadanoController@enviarCorreo')->dailyAt('00:00'); //descomentar para salida oficial


        $schedule->call('App\Http\Controllers\NotificacionCiudadanoController@enviarCorreo')->everyFiveMinutes(); //comentar para salida oficial
        
        $schedule->call('App\Http\Controllers\NotificacionQuincenalController@enviarCorreo')->cron('*/10 * * * * *')->withoutOverlapping();//comentar para salida oficial

        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
