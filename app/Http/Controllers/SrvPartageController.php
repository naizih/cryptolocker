<?php

namespace App\Http\Controllers;

use App\Models\Srv_partage;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;




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

        //$partag = new Srv_partage;  // instance de mode Srv_partage

        /*
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
            'shared_folder' => 'required',
            'local_mount_path' => 'required',
            'password' => 'required',
        ]);
*/
        
/*

        if(Storage::exists($request->local_mount_path)){
            return redirect()->back()->withErrors(['message' => 'Un dossier avec nom '. $request->local_mount_path.' existe déja.'])->withInput();
        }
        Storage::makeDirectory($request->local_mount_path);
*/



        //fopen('\\\\192.168.176.2\\Drive\\appat.txt',"r");

        $local_path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        //$output = exec("echo 'user' | sudo -S mount -t cifs -o user=projm1_21,pass=5IwEc39Y8h9T //192.168.176.2/projetm12021 /home/user/cryptolocker_V1.3/cryptolocker/storage/app/partage2");
        //exec("echo 'user' | sudo -S mount -t cifs -o user=projm1_21,pass=5IwEc39Y8h9T //192.168.176.2/projetm12021 /home/user/cryptolocker_V1.3/cryptolocker/storage/app/partage2");
        

        //system('net use "\\\\192.168.176.2\\projetm12021" 5IwEc39Y8h9T /user:projm1_21 /persistent:no>nul 2>&1"');

        //exec('nohup php artisan check:mountdrive > /dev/null &');


        //echo shell_exec('pwd');
        $file = base_path()."/app/Bash/mount.sh projm1_21 5IwEc39Y8h9T 192.168.176.2 projetm12021 partage2";
       

        //exec('python3 ../app/Bash/script.py');

        $old_path = getcwd();
        $n = chdir(base_path().'/app/Bash/');

        echo getcwd();
        echo '<br>';

        $command = "sudo ".base_path()."/app/Bash/mount.sh";


        //exec('sudo mount.sh');
        //echo shell_exec('./mount.sh');

        file_exists('mount.sh');
/*
        if(file_exists('mount.sh')) {
            system('sudo mount.sh');
        }else{
            die('File not found!'); 
        }
*/
        echo 'pwd ==> '.shell_exec('pwd');
        echo '<br>';
        echo 'ls ==> '.shell_exec('ls -l');

        //exec('sudo /home/user/cryptolocker_V1.3/cryptolocker/app/Bash/mount.sh');

        echo '<br>';

        $process = new Process(['sh', 'mount.sh']);
        $process->run();

        

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();


        
        //echo "<pre>$output</pre>";

        //Storage::makeDirectory($request->local_mount_path);

/*
        $partag->create([
            'ip' =>  $request->ip,
            'utilisateur' =>  $request->user,
            'dossier_partager' => $request->shared_folder,
            'partage_monter' => $request->local_mount_path,
            'password' => $request->password,
        ]);
*/

        //return redirect('/config/srv-partage')->with('message', "Votre Nouveau compte de partage est ajouter avec succès.");
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

        return redirect('/config/srv-partage')->with('message', "Votre compte de partage est modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Srv_partage  $srv_partage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Srv_partage $srv_partage, Request $request)
    {
        $id = $request->id;

        $srv_partage->where('id', $id)->delete();
        
        return redirect('/config/srv-partage')->with('message', "Le Compte partagé est supprimer avec succès.");
    }
}
