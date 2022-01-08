<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\info_serveur_mgmt;       //info serveur mgmt
use Illuminate\Support\Facades\Session;
use App\Models\Client_information;


class ConfigController extends Controller
{
    public function index() {
        // 
    }


    //configuration deuserveur partage
    public function server_partage() {
        $server_info = info_serveur_mgmt::first();
        return view('pages.config.information_serveur_partage', ['info_serveur' => $server_info]);   
    }

    

    public function verification_de_connexion(){

        $server_ip = info_serveur_mgmt::first()->IP;            //GET serveur adresse IP.
        $server_port = "81";  

        $url = $server_ip.':'.$server_port.'/api/connexion';
        $ch = curl_init($url);
        
        $handle = curl_init($url);                                  //it initialize a new session and return a cURL handle
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);        // set options for a CURL session identified by the ch parameter
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        
        // condition pour envoyer la reponse de connexion au utilisateur.
        if($httpCode == "200"){
            $res = Session()->flash('message', "Vous etes bien connecté au serveur management");
            return redirect()->back();
        }else{
            $response = Session()->flash('error', "Vous n'etes pas connecté!");
            return redirect()->back();
        }

    }


    public function create()
    {
        //
    }

    
    public function store(Request $request){
        //
    }

    
    public function show(Config $config)
    {
        //
    }

   
    public function edit(Config $config)
    {
        // lien pour afficher les données à modification
       
    }

    
    public function update(Request $request, Config $config)
    {
        //
        //validation de données
      
    }

    
    public function destroy(Config $config)
    {
        //
    }
}
