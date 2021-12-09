<?php

namespace App\Http\Controllers;

use App\Models\Hash_File_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

use App\Models\Client_information;



class HashFileModelController extends Controller
{
    public function bash(Request $request) {
        //return Response::json(['response'=> $request]);
        //return redirect()->response()->js
        return response()->json(['success' => 'la fichier est ajouter avec succces.']);

    }
    public function index()
    {
        //
        //recuperie tous les données de la base de donnée que se trouve dans la table 
        //$data = Hash_File_Model::all();
        //return view('accueil', ['table_fichier_hash' => $data]);
        
        $info_client = Client_information::all();
        return view('accueil', ['information_client' => $info_client]);

        //boucle infini pour tester les hashe de fichier
        //$data = Hash_File_Model::select('nom_de_fichier')->get();
        //dd($data);

    }

    // fonction pour afficher tous les données de la base de données 
    public function api_datashow(){
        $data = Hash_File_Model::all();
        //return response()->json($data);

        return response()->json([
            'fichiers_hash' => $data
        ], Response::HTTP_OK);
    }
   

     //Retourner un affichage avec form
     //The create method should return a view with a form.
    public function create()
    {
        //
    }




    // sauvgarder les donées de la formulaire ajouter un nouveau fichier .
    public function store(Request $request){
        if ($request->hasFile('file')){
            $file = $request->file('file');         // fichier qui est envoyé par client.
            $file_name = $file->getClientOriginalName();    //le nom original de la fichier
            $contents = $file->get('originalName');     //contenu de fichier.
            $hash = md5($contents);     //changer le contenu de fichier en format hash, j'ai utilisé 
            $path = $request->path;     // données de input chemin_de_fichier
        }

        Hash_File_Model::create([
            'nom_de_fichier' => $file_name,
            'Chemin_de_fichier' => $path,
            'Hash_de_fichier' => $hash,
        ]);
        
        return response()->json(['success' => 'la fichier est ajouter avec succces.']);
    }

/*
    //The store method should handle the form and create the entity and redirect.
    public function store(Request $request) {
        //validation de données avant le sauvgarder.
        request()->validate([
            'chemin' => 'required',
            'fichier' => 'required',
        ]);
  
        $file = $request->file('fichier');                              // variable pour recuperer  le fichier telecharger(upload) par utilisateur
        $contents = $file->get('originalName');                         // variable pour recuperer les contenu de fichier upload par utilisateur
        $hash = md5($contents);                                         // variable qui va contenir le hash du fichier 
        $file_name = $request->fichier->getClientOriginalName();        //variable pour recuperer  le nom original de fichier

        //saugrader les données dans le sqlite3
        Hash_File_Model::create([
            'nom_de_fichier' => $file_name,
            'Chemin_de_fichier' => request('chemin'),
            'Hash_de_fichier' => $hash,
        ]);
        
        //retourber vers la page de index.
        return redirect('/');

        //script pour valider la hash de fichier appat tous les 3 Min.
    }
*/

    //fonction pour checker les fichier
    public function check(Request $request) {
        //$names_string = $request->name;     //recevoir les noms de fichier dans le methode post, et le typed de données est string 
        //$names_array = explode(",",$names_string);    // changer le type de donner en format tableau.
        $paths_string = $request->path;     //lien de fichier en format de type 'string'. 
        $paths_array = explode(',', $paths_string);     // lien absolute de fichier en form array.

        $ids_string = $request->id;
        $ids_array = explode(',', $ids_string);
       
        $array_length = count($paths_array);        // nombre de fichier 
        $hash_result = [];      // variable pour sauvgarder temporairement le resultat de comparaison de hash. 

        // boucle for pour comparer tous les ligne de la tables.
        for ($index = 0; $index < $array_length; $index++) {
            $hash = md5_file($paths_array[$index]);         // hash de fichier sauvgarder.

            $row_database = Hash_File_Model::find($ids_array[$index]);      //variable pour trouver la ligne coresspondance 
            $hash_database = $row_database->Hash_de_fichier;            // trouver le hash de la ligne correspondace

            if ($hash != $hash_database){
                array_push($hash_result, "\r\n File name : ".$row_database->nom_de_fichier . " => Nouveau Hash :" .$hash);   
            }
        }
        return response()->json(['hash_result' => $hash_result]);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hash_File_Model  $hash_File_Model
     * @return \Illuminate\Http\Response
     */
    public function show(Hash_File_Model $hash_File_Model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hash_File_Model  $hash_File_Model
     * @return \Illuminate\Http\Response
     */
    //The edit method should return a view with a form with data from the entity.
    public function edit(Hash_File_Model $hash_File_Model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hash_File_Model  $hash_File_Model
     * @return \Illuminate\Http\Response
     */
    //The update method should handle the form and update the entity and redirect.
    public function update(Request $request, Hash_File_Model $hash_File_Model)
    {
        //
    }


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
}
