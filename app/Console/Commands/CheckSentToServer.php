<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Models\Client_information;     // importer Client_information Model
use App\Models\Hash_File_Model;     // importer le Model Hash_File_Model
use App\Models\Temps_script;     // importer Client_information Model
Use Carbon\Carbon;     // Importer Model for date and time

use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Route;


class CheckSentToServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sendtoserver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoyer le resultat de check au bout de temps fixée par administrateur au serveur management.';

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
        $file_result = [];  // collection de resultat de check
        
        $get_client_email = Client_information::select('email')->first();     // GET Client email adresse
        $variable_temps = Temps_script::all()->first();     // GET Client email adresse
        $data = Hash_File_Model::all();

        $temps_check = $variable_temps->temps_check;        // GET temps pour envoyer un alert

        $ind = 0;
        // we send data if check result is good or not 
        // we send alert in data if Trois_check_not_ok is true
        foreach ($data as $index => $file){
            $alert = false;     // variable pour savoir coté serveur management si il y'a eu un alert ou pas 
            $date_last_not_ok = $file->Trois_check_not_ok;   // date de dernier Trois_check_not_ok
            $string_date = carbon::parse($date_last_not_ok);
            $diff_minute = carbon::now()->diffInMinutes($string_date);     // difference entre le date actuelle est le date de variable Trois_check_not_ok
            
            // if diff() entre le date actuel est le data de Trois_check_not_ok est > temps_check
            if ($diff_minute > intval($temps_check) ){
                $alert = true;
            }

            $ind = $ind + $index;

            $file_result[] = [
                //information de client
                'nom_entreprise' =>  request('nom_entreprise'),
                'site' =>  request('site'),
                'nom_client' => request('nom_client'),
                'mobile' => request('mobile'),
                'client_email' => $get_client_email->email,
                
                // information de fichier
                'file_name' => $file->nom_de_fichier,
                'file_path' => $file->Chemin_de_fichier,
                'check_result' => $file->resultat_de_check,
                'last_check' => $file->date_du_dernier_check,
                'alert' => $alert,
            ];
        }

        
        //dd($file_result);

        $response = HTTP::post('http://192.168.141.174:81/api/resultat_check', $file_result);
        //$request = $client->post('http://192.168.141.174:81/api/try')->addPostFiles(['file' => $file_result]);
        //$request->send(); 

        //curl -d "{'info' { 'client_email':'hello@gmail.com', 'file_name':'appat.txt', 'file_path':'/mnt/partage1/Drive_client', 'check_result': 'NOT OK', 'last_check':'2021-12-17 15:29:02', 'alert':'true'}}" -X POST http://192.168.141.174:81/api/resultat_check
        //curl -d @json_test_data.json  -H "Content-Type: application/json"  http://192.168.141.174:81/api/resultat_check



        //return $post->json();
        //dd($file_result);
        
        //$response = $post;
        $this->info($response);

        //$this->info('Le resultat de check est bien envoyer au serveur management.');
        //return Command::SUCCESS;
    }
}
