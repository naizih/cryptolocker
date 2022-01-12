<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Temps_script;     // importer Client_information Model

use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\CheckAllFile::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {

        $variable_temps = Temps_script::all()->first();     // GET Client email adresse
        $temps_envoie_srv = $variable_temps->temps_envoie_server_mgmt;
        //dd($temps_check);
      
        $schedule->command('check:minute')->everyMinute();
        $schedule->command('check:sendtoserver')->cron('*/'.$temps_envoie_srv.' * * * *');

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
