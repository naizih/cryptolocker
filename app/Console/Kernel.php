<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Temps_script;     // importer Client_information Model
use App\Models\Hash_File_Model;     // importer Model Hash_File_Model

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

        
        function execute_check(){
            $res = false;
            $variable_temps = Temps_script::all()->first();     // GET Client email adresse
            $temps_check = $variable_temps->temps_check;

            $data_hash_file = Hash_File_Model::select('date_du_dernier_check')->where('resultat_de_check', 'OK')->first();
            $date_string = $data_hash_file->date_du_dernier_check;
            $change_string_date_to_date = carbon::parse($date_string);

            $newDateTime = $change_string_date_to_date->addMinutes(intval($temps_check));

            $diff_time = carbon::now()->diffInMinutes($newDateTime);
            
            if ($diff_time > intval($temps_check)){
                $res = true;
            }else{
                $res = false;
            }
            return $res;
        } 


      
        // we have to make different between current time and last_check time + 3 minute

      
        
        $schedule->command('check:minute')->everyMinute();



        /*
         ->when(function() use($res){
                    return $res;
                });
            */
        //$schedule->command('check:minute')->$temps_check;
        /*
        $schedule->command('check:minute')
                ->cron($temps_check);
        */


        /*
        $schedule->call(function(){
            $currentTime = Carbon::now();
            return response()->json(['hello time:'.$currentTime]);
        })->everyMinute();
        */
        // $schedule->command('inspire')->hourly();
        //return response()->json(Response::HTTP_OK)->everyMinute();
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
