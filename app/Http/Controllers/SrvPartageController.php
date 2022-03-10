<?php

namespace App\Http\Controllers;

use App\Models\Srv_partage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class SrvPartageController extends Controller
{

    public function index()
    {
        //
        $server_info = Srv_partage::all();
        return view('serveur_partage.view_serveur_partage', ['info_serveur' => $server_info]);   
    }


    public function create()
    {
        return view('serveur_partage.add_serveur_partage'); 

    }


    public function store(Request $request, Srv_partage $partag ) {

        $partag = new Srv_partage;  // instance de mode Srv_partage
        $last_record = Srv_partage::latest()->first();

        $directory_name = 1;

        // Partage Drive Name sync with database....
        if ($last_record){
            $directory_name = $last_record->partage_monter + 1;
        }
        

        // Validation des données
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
            'shared_folder' => 'required',
            'password' => 'required',
        ]);

        
        // Créé le dossier sur lequel on va monter le partage
        if(Storage::exists($request->directory_name)){
            return redirect()->back()->withErrors(['message' => 'Un dossier avec nom '. $directory_name.' existe déja.'])->withInput();
        }
        Storage::makeDirectory($directory_name);
        

        // Get current working directory
        $old_path = getcwd();
        $n = chdir(base_path().'/app/Bash/');       // changer le dossier au dosssier ou se trouve le fichier de script.

        // Lancer le commande
        //exec("echo 'user' | sudo -S mount.cifs -o user=".$request->user.",pass=".$request->password.",vers=1.0 //".$request->ip."/".$request->shared_folder." /home/user/cryptolocker_V1.3/cryptolocker/storage/app/".$directory_name, $output, $return);
        
        $local_dir = storage_path().'/app/'.$directory_name;

        exec("./mount.sh $request->user $request->password $request->ip $request->shared_folder $local_dir", $output, $return);



        if ($return == 0){
            // ajouter le nouveau partage dans le base de données
            $partag->create([
                'ip' =>  $request->ip,
                'utilisateur' =>  $request->user,
                'dossier_partager' => $request->shared_folder,
                'partage_monter' =>  $directory_name,
                'password' => $request->password,
            ]);
        }else{
            Storage::deleteDirectory($directory_name);
            return redirect()->back()->with('error', "Il y a un problem soit dans le system ou soit votre identifiant sont incorrects!")->withInput();
        }
        
        chdir($old_path);       // change working diretory to default working directory.


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
        //
        
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
        //
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
