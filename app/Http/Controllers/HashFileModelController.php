<?php

namespace App\Http\Controllers;

use App\Models\Hash_File_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

use App\Models\Client_information;
Use \Carbon\Carbon;



class HashFileModelController extends Controller
{
    public function index() {
        $data = Hash_File_Model::all();
        
        $info_client = Client_information::all();
        return view('accueil', ['information_client' => $info_client, 'table_fichier_hash' => $data]);
    }


    // fonction pour afficher tous les données qui sont dans la base de données 
    /*
    public function api_datashow(){
        $data = Hash_File_Model::all();
        //return response()->json($data);

        return response()->json([
            'fichiers_hash' => $data
        ], Response::HTTP_OK);
    }
    */
   


    //fonction  pour choisir le fichier qui va etre check
    public function select_file( Request $folder ){
        $dir = '/home/user/cryptolocker_V1.3/cryptolocker/storage/app/';      // l'endroit de montage de partage

        // si le variable file est present dans le URL
        if(isset($_GET['file'])){ $dir = $dir.$_GET['file']; }
       
        // iteration
        function iter_file($dir){
            $result = [];       // variable pour retourner le resultat dans forma de tableau
            if (is_dir($dir)) {     // si on est dans le directory
                if ($dh = opendir($dir)) { // si il y a un autre dossier dans le dossier où on est
                    while (($file = readdir($dh)) !== false) {
                        // le . et .. sont des directory par default dans linux
                        if($file === '.' || $file === '..') { continue; }

                        // si on clique sur le fichier 
                        if(filetype($dir.'/'.$file) === 'file'){
                            array_push($result, [ 'name' => $file, 'path' => $dir, 'filetype' => 'file']);
                            //return $result;
                        }
                        //si on clique sur le dossier
                        if(filetype($dir.'/'.$file) !== 'file')
                            array_push($result, [ 'name' => $file, 'path' => $dir, 'filetype' => 'dir']);
                    }
                    // fermer directory
                    closedir($dh);
                }
                return $result;
            }
        }

        // variable qui appele à fonction iter_file
        $res = iter_file($dir);
        return view('pages.ajouter_fichier_appat', ['files' => $res]);
    }




     //Retourner un affichage avec form
     //The create method should return a view with a form.
    public function create() {
        //
    }


    // sauvgarder les donées de la formulaire ajouter un nouveau fichier .
    public function store(Request $request){
       
        //validation des données entrée 
        request()->validate([
            'chemin_de_fichier' => 'required',
            'nom_de_fichier' => 'required',
        ]);

        $file = $request->chemin_de_fichier.'/'.$request->nom_de_fichier;       // chemin absolu vers le ficheir
        $hash = md5_file($file);        // calculer le hash de fichier
        
        Hash_File_Model::create([
            'nom_de_fichier' => $request->nom_de_fichier,
            'Chemin_de_fichier' => $request->chemin_de_fichier,
            'Hash_de_fichier' => $hash,
            'resultat_de_check' => 'OK',
            'date_du_dernier_check' => Carbon::now()->toDateTimeString(),
            'Trois_check_not_ok' => Carbon::now()->toDateTimeString(),
        ]);
        
        return redirect('accueil');
        //return response()->json(['success' => 'la fichier est ajouter avec succces.']);
    }

    // function pour savoir l'action d'utilisateur et appeler à la fonction correspondance
    public function check_supprimer(Request $request){
         // valider les input
        $request->validate([
            'checkbox' => 'required',
        ]);

        if(isset($request->delete) && $request->delete == "supprimer" ){
            HashFileModelController::destroy_multiple_laravel($request);
        }
        if(isset($request->check) && $request->check = "check"){
            CheckController::check($request);
        }
        return redirect()->back();
    }


    


    // fonction pour supprimer pleusieurs lignes, pure laravel (php)
    public function destroy_multiple_laravel(Request $request){
        //avant de supprimer on valide si utilisateur a bien selectioner la checkbox ou pas
        $request->validate([
            'checkbox' => 'required',
        ]);

        $checkbox = $_POST['checkbox'];
        
        if(isset($_POST['delete']) && !empty($checkbox)){
            $checkbox = $_POST['checkbox'];
            $nb_delete_record = count($checkbox);
            
            for( $i=0; $i < $nb_delete_record; $i++ ){
                $del_id = $checkbox[$i];
                Hash_File_Model::where('id', $del_id)->delete();
            }
            //return redirect('/');
        }
        //return response("vous n'avez pas selectionée aucune ligne pour supprimer ! <br> Pour aller à l'accueil cliquer <a href='/'> ici .</a>");
       // return redirect('/');
    }


    // fonction pour supprimer un ligne de tableau, requet recu de vue.js
    public function destroy(Hash_File_Model $id) {
        $id->delete();
        return response()->json(['response' => 'le ligne est supprimer avec success']);

    }

    //fonction pour supprimer plusieur record en meme temps
    public function destroy_multiple(Request $request){
        try {
            $ids = $request->id;        // variable pour recuperier les ID de checkbox.
            foreach ($ids as $id) {
                Hash_File_Model::where('id', $id)->delete();
            }
            return response()->json(['response' => 'les case à cocher sont supprimer avec success']);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(Hash_File_Model $hash_File_Model)
    {
        //
    }

    //The edit method should return a view with a form with data from the entity.
    public function edit(Hash_File_Model $hash_File_Model)
    {
        //
    }


    //The update method should handle the form and update the entity and redirect.
    public function update(Request $request, Hash_File_Model $hash_File_Model)
    {
        //
    }
}
