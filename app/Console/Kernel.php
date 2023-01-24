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
        Commands\ChangeStatus::class,
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
        //     $my_apikey = "ZJFOVG1W5TTL3OEPVEQK";
        //     $api_url = "http://panel.rapiwha.com/send_message.php";
        //     $api_url .= "?apikey=". urlencode ($my_apikey);
        //     $api_url .= "&number=". urlencode ("6289508867687");
        //     $api_url .= "&text=". urlencode ("hallo");
        //     $my_result_object = json_decode(file_get_contents($api_url, false));
        // })->everyMinute()->runInBackground()
        // ->emailOutputTo('desirmd3012@gmail.com');

        $schedule->command('status:check')->everyMinute()->runInBackground();
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
