<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Http\Request;

use App\Models\Hash_File_Model;
Use Carbon\Carbon;     // use this class for date and time

use Illuminate\Support\Facades\DB;      //for using table 

/*

 $date = "2021-12-16 14:34:31";
        $n_date =Carbon::now();

        $date_to_nb = Carbon::parse($date);

        $days = $n_date->diffInMinutes($date_to_nb); 
        dd($days);

*/

class CheckController extends Controller {

    //fonction pour checker les fichier
    public function check(Request $request) {
        // validation de données est fait dans le fonction check_supprimer()

        $checkbox = $request->checkbox;     //
        if(isset($_POST['check']) && !empty($checkbox)){
            $nb_selected_record = count($checkbox);     // longueur de array ( nombre de checkbox selectionnées )
            $query = Hash_File_Model::whereIn('id', $checkbox)->get();      // GET all checked checkbox data from database
            $error = [];        // after use


            // boucle for pour comparer tous les ligne de la tables.
            for ($index = 0; $index < $nb_selected_record; $index++) {
                $name_stored = $query[$index]->nom_de_fichier;      // get file name from database
                $path_stored = $query[$index]->Chemin_de_fichier;   // get path from dataabse
                $hash_stored = $query[$index]->Hash_de_fichier;     // get Hash from database
                
                $file_path = $path_stored.'/'.$name_stored;
                $hash = md5_file($file_path);         // hash de fichier partagé.

                // modification le date de column dernier_check and Trois_check_not_ok also put a zero
                DB::table('hash__file__models')->where('id', $checkbox[$index])->update(['date_du_dernier_check' => Carbon::now()->toDateTimeString()]);

                if ($hash != $hash_stored){                    
                    DB::table('hash__file__models')->where('id', $checkbox[$index])->update(['resultat_de_check' => "NOT OK"]);

                    //array_push($error, "\r\n File name : ".$row_database->nom_de_fichier . " => Nouveau Hash :" .$hash);   
                }else{  // si le hash de fichier n'est pas different mettre à jour la column Trois_check_not_ok.
                    DB::table('hash__file__models')->where('id', $checkbox[$index])->update(['Trois_check_not_ok' => Carbon::now()->toDateTimeString(), 'resultat_de_check' => 'OK']);
                }
            }
            //return response()->json(['error' => $error]);
        }
        //return redirect('/');
    }

}