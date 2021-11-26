<?php

namespace App\Http\Controllers;

use App\Models\Hash_File_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;


class HashFileModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //recuperie tous les données de la base de donnée que se trouve dans la table 
        $data = Hash_File_Model::all();
        return view('accueil', ['table_fichier_hash' => $data]);


        //boucle infini pour tester les hashe de fichier
        //$data = Hash_File_Model::select('nom_de_fichier')->get();
        //dd($data);

    }

    public function api_datashow(){
        $data = Hash_File_Model::all();
        //return response()->json($data);

        return response()->json([
            'fichiers_hash' => $data
        ], Response::HTTP_OK);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     //Retourner un affichage avec form
     //The create method should return a view with a form.
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //The store method should handle the form and create the entity and redirect.
    public function store(Request $request)
    {
 
        //validation de données avant le sauvgarder.
        request()->validate([
            'chemin' => 'required',
            'fichier' => 'required',
        ]);

        
        //$contents = Storage::disk('local')->get('appat.txt');
        //dd($content = file_get_contents(Hash_File_Model::file('fichier')->getRealPath()));

        //$disk = Storage::disk('local');
        //$file = $request->get('fichier');
        //$path = Storage::path($file);

        //$f = $request->file('file-content');
        //$contents = file_get_contents(Hash_File_Model::file('fichier')->getRealPath());
        //dd($contents);


    
        /*
        $file => variable pour recuperer  le fichier telecharger(upload) par utilisateur
        $contents => variable pour recuperer les contenu de fichier upload par utilisateur
        $hash => variable qui va contenir le hash du fichier 
        $filename => variable pour recuperer  le nom original de fichier
        */    
        $file = $request->file('fichier');
        $contents = $file->get('originalName');
        $hash = md5($contents);
        $file_name = $request->fichier->getClientOriginalName();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hash_File_Model  $hash_File_Model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hash_File_Model $id)
    {
        
        //$single_user_id = explode(',' , $id);

        dd($id);
        //$id->delete();
        //return redirect('/');
        /*
        foreach($single_user_id as $id) {
            Hash_File_Model::findOrFail($id)->delete();
        }
        */

    }
}
