<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use App\Models\Client_information;      // importer le modèle Client_information
use App\Models\Hash_File_Model;         // importer le modèle Hash_File_Model
use App\Models\Temps_script;            // importer le modèle temps_script
use App\Models\info_serveur_mgmt;       // importer le modèle info_serveur_mgmt
Use Carbon\Carbon;                      // Importer le modèle pour date et l'heure

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
        // le fonctionnement de cette fonction est d'envoyer un alert si 
        // la variable Trois_check_not_ok est trois fois plus que la variable
        // de lancement de script pour checker les fichiers il va envoyer 
        // une alerte dans les données qu'il envoie au serveur management.

        $file_result = [];  // collection de resultat de check

        $client = Client_information::all()->first();       // récupérer le premier ligne de la table clietn_information
        $variable_temps = Temps_script::all()->first();     // récupérer le premier ligne de la table temps_script
        $data = Hash_File_Model::all();                     // récupérer tous les données de la table de hash_file_models
        $SRV_PRTG = info_serveur_mgmt::first();             // récupérer le premier ligne de la table info_serveur_mgmt

        $temps_check = $variable_temps->temps_check;        // récupérer le valeurs de temps_check ( le valeurs de temps de lancement de script pour checker tous les ficheirs)

        // Boucle tourne le nombre de fois que le fichier existe.
        foreach ($data as $index => $file){
            $alert = false;                                             // variable pour savoir coté serveur management si il y'a eu un alert ou pas 
            $date_last_not_ok = $file->Trois_check_not_ok;              // récupérer la dernière valeur de variable Trois_check_not_ok
            $string_date = carbon::parse($date_last_not_ok);            // changer le format de date.
            $diff_minute = carbon::now()->diffInMinutes($string_date);  // difference entre le date actuelle est le date de variable Trois_check_not_ok
            
            // variable pour checker si la différence entre la date actuelle est la date de trois_check_not_ok
            if ($diff_minute > ( 3 * intval($temps_check)) ){
                $alert = true;
            }

            // Mettre tous les données dans le tableau
            $file_result[] = [
                //information de client
                'nom_entreprise' =>  $client->nom_entreprise,
                'site' =>  $client->site,
                'nom_client' => $client->nom_client,
                'mobile' => $client->mobile,
                'client_email' => $client->email,
                
                // information de fichier
                'file_name' => $file->nom_de_fichier,
                'file_path' => $file->Chemin_de_fichier,
                'check_result' => $file->resultat_de_check,
                'last_check' => $file->date_du_dernier_check,
                'alert' => $alert
            ];
        }

        $response = HTTP::post($SRV_PRTG->IP_DNS.'/api/resultat_check', $file_result);
        $this->info($response);

        //return Command::SUCCESS;
    }
}
