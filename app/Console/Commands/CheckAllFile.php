<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Hash_File_Model;     // Model utilisé
Use Carbon\Carbon;     // use this class for date and time
use Illuminate\Support\Facades\DB;      //for using table 


use App\Models\Temps_script;     // importer Client_information Model


class CheckAllFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check tous les 3 minutes hash de tous les fichier';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        /*
        $date = "2021-12-16 14:34:31";
        $n_date =Carbon::now();

        $date_to_nb = Carbon::parse($date);

        $days = $n_date->diffInMinutes($date_to_nb); 
        dd($days);
        */

        /*function execute_check(){
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
        */

       

        $variable_temps = Temps_script::all()->first();     // GET Client email adresse
        $temps_check = $variable_temps->temps_check;

        $data_hash_file = Hash_File_Model::select('date_du_dernier_check')->where('resultat_de_check', 'OK')->first();
        $date_string = $data_hash_file->date_du_dernier_check;

        $change_string_date_to_date = carbon::parse($date_string);

        $newDateTime = $change_string_date_to_date->addMinutes(intval($temps_check));
        
        //dd($newDateTime->toDateTimeString());
        //dd((carbon::now()->diffInMinutes($newDateTime)));

        $all_data = Hash_File_Model::all();     // GET all data
        $files_number = count($all_data);       // nombre de fichier 
        
        //dd($all_data[0]->id);

        for ($ligne = 0; $ligne < $files_number; $ligne++) {
            $name_stored = $all_data[$ligne]->nom_de_fichier;      // get file name from database
            $path_stored = $all_data[$ligne]->Chemin_de_fichier;   // get path from dataabse
            $hash_stored = $all_data[$ligne]->Hash_de_fichier;     // get Hash from database
            $file_id = $all_data[$ligne]->id;                      // get file ID

            $file_path = $path_stored.'/'.$name_stored;
            $hash = md5_file($file_path);         // nouveau hash de fichier partagé.

             // modification le date de column dernier_check
             DB::table('hash__file__models')->where('id', $all_data[$ligne]->id)->update(['date_du_dernier_check' => Carbon::now()->toDateTimeString()]);

             if ($hash != $hash_stored){                    
                 DB::table('hash__file__models')->where('id', $file_id)->update(['resultat_de_check' => "NOT OK"]);
             }else{  // si le hash de fichier n'est pas different mettre à jour la column Trois_check_not_ok.
                 DB::table('hash__file__models')->where('id', $file_id)->update(['Trois_check_not_ok' => Carbon::now()->toDateTimeString(), 'resultat_de_check' => 'OK']);
             }
        }

        //return Command::SUCCESS;
        $this->info('Check commande has been executed with success');
    }
}
