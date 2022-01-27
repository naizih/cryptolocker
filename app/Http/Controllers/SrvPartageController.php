<?php

namespace App\Http\Controllers;

use App\Models\Srv_partage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class SrvPartageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $server_info = Srv_partage::all();
        return view('serveur_partage.view_serveur_partage', ['info_serveur' => $server_info]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serveur_partage.add_serveur_partage'); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request, Srv_partage $partag ) {

        $partag = new Srv_partage;  // instance de mode Srv_partage

        // Validation des données
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
            'shared_folder' => 'required',
            'local_mount_path' => 'required',
            'password' => 'required',
        ]);

        
        // Créé le dossier sur lequel on va monter le partage
        if(Storage::exists($request->local_mount_path)){
            return redirect()->back()->withErrors(['message' => 'Un dossier avec nom '. $request->local_mount_path.' existe déja.'])->withInput();
        }
        Storage::makeDirectory($request->local_mount_path);


        // Get current working directory
        $old_path = getcwd();
        $n = chdir(base_path().'/app/Bash/');       // changer le dossier au dosssier ou se trouve le fichier de script.

        // Lancer le commande
        system('./mount.sh '.$request->user.' '.$request->password.' '.$request->ip.' '.$request->shared_folder.' '.$request->local_mount_path);

        chdir($old_path);       // change working diretory to default working directory.
        
        // ajouter le nouveau partage dans le base de données
        $partag->create([
            'ip' =>  $request->ip,
            'utilisateur' =>  $request->user,
            'dossier_partager' => $request->shared_folder,
            'partage_monter' => $request->local_mount_path,
            'password' => $request->password,
        ]);

        // redirigé avec le message de succès.
        return redirect('/config/srv-partage')->with('message', "Votre Nouveau compte de partage est ajouter avec succès.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Srv_partage  $srv_partage
     * @return \Illuminate\Http\Response
     */
    public function show(Srv_partage $srv_partage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Srv_partage  $srv_partage
     * @return \Illuminate\Http\Response
     */
    public function edit(Srv_partage $srv_partage, $id)
    {
        $server_info = $srv_partage->whereId($id)->first();
        return view('serveur_partage.edit_serveur_partage', ['info_partage' => $server_info]); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Srv_partage  $srv_partage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Récuperier tous les données.
        //$data = $request->except('_method','_token','submit');
        
        //validation de données
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
            'shared_folder' => 'required',
            'local_mount_path' => 'required',
            'password' => 'required',
        ]);

        // Trouver le ligne correpondance
        $srv_partage = Srv_partage::find($id);

        //mise à jour des données dans le base de donnée.
        $srv_partage->update([
            'ip' =>  $request->ip,
            'utilisateur' =>  $request->user,
            'dossier_partager' => $request->shared_folder,
            'partage_monter' => $request->local_mount_path,
            'password' => $request->password,
        ]);

        // Quand on mis à jour un partage on relance notre script
        $old_path = getcwd();                       // Get current working directory
        $n = chdir(base_path().'/app/Bash/');       // changer le dossier au dosssier ou se trouve le fichier de script.
        system('./mount.sh '.$request->user.' '.$request->password.' '.$request->ip.' '.$request->shared_folder.' '.$request->local_mount_path);
        chdir($old_path);       // change working diretory to default working directory.


        return redirect('/config/srv-partage')->with('message', "Votre compte de partage est modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Srv_partage  $srv_partage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Srv_partage $srv_partage, Request $request) {
 
        // variables
        $id = $request->id;
        $script_directory = base_path().'/app/Bash';       // Dossier de fichier scripts.
        $mount_directory = storage_path('app').'/'.$request->local_mount_path;

        system($script_directory.'/umount.sh '.$mount_directory);     // unmount the drive.

        // supprimer le dossier
        Storage::deleteDirectory($request->local_mount_path);

        // supprimer la ligne correspondance dans le base de données.
        $srv_partage->where('id', $id)->delete();        

        return redirect('/config/srv-partage')->with('message', "Le Compte partagé est supprimer avec succès.");

    }
}
