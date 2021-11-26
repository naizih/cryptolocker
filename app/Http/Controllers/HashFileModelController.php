<?php

namespace App\Http\Controllers;

use App\Models\Hash_File_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
        return view('accueil', ['fichier_hash' => $data]);
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
 
        /*
        $request()->validate([
            'fichier' => 'required',
        ]);

        //hashFile('file_name')
        */
        
        //$contents = Storage::disk('local')->get('appat.txt');
        //dd($content = file_get_contents(Hash_File_Model::file('fichier')->getRealPath()));


        //$disk = Storage::disk('local');
        //$file = $request->get('fichier');
        //$path = Storage::path($file);

        $file = $request->file('fichier');
        $f = $request->file('file-content');
        //$contents = $file->get('originalName');
        //$hash = md5($contents);
        dd($f);
        //$contents = file_get_contents(Hash_File_Model::file('fichier')->getRealPath());
        //dd($contents);

        
    

        /*
        Data::create([
            'Chemin_de_fichier' => request('name'),
            'Hash_de_fichier' => request('email'),
        ]);
        */

        //return redirect('/');
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
    public function destroy(Hash_File_Model $hash_File_Model)
    {
        //
    }
}
