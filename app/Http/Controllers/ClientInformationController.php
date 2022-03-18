<?php

namespace App\Http\Controllers;

use App\Models\Client_information;
use Illuminate\Http\Request;
use App\Models\info_serveur_mgmt;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Http;



class ClientInformationController extends Controller
{
   
    // on retourne notre information vers la page de config et dans la page config, on inclue le code html dans l'info_client
    public function index() {
        $info_client = Client_information::all();
        return view('pages.config.information_serveur_client', ['information_client' => $info_client]); 

    }


    public function verification_de_connexion(){

        //$server_port = "81";  

        $info_serveur_mgmt = info_serveur_mgmt::all();
        if (count($info_serveur_mgmt) > 0 ){
            $server_ip = $info_serveur_mgmt->first()->IP_DNS;          //GET serveur adresse IP.
        }else{
            return redirect()->back()->withErrors("Vous n'avez pas définir encore l'adresse IP/DNS du serveur management.")->withInput();
        }

        $url = $server_ip.'/api/connexion';
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

    

    public function store(Request $request, Client_information $client ) {
        //
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'site' => 'required',
            'nom_client' => 'required',
            'mobile' => 'string|min:10',
            'email' => 'required',
        ]);

        
        if (!$client->all()->count() > 0 ){
            $client->create([
                'nom_entreprise' =>  $request->nom_entreprise,
                'site' =>  $request->site,
                'nom_client' => $request->nom_client,
                'mobile' => $request->mobile,
                'email' => $request->email,
            ]);
        }

/*
        $file_result[] = [
            //information de client
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'client_email' => $request->email,
            
            // information de fichier
            'file_name' => '',
            'file_path' => '',
            'check_result' => '',
            'last_check' => '',
            'alert' => false
        ];
*/

        /*
        // On peut utiliser ce methode, ça marche aussi
        $server_ip = info_serveur_mgmt::first()->IP;
        $response = HTTP::post($server_ip.'/api/resultat_check', $file_result);
        */


        $server_ip = info_serveur_mgmt::first()->IP_DNS;      
        $post = HTTP::post($server_ip.'/api/update_client', [
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        //$post->send();

        $response = $post->json();
        return redirect('/config')->with('message', "Le client est ajouter avec success dans le serveur client ".$response['message']);

        //return redirect('/config')->with('message', "Le client a été ajouté avec success! et ".$response['message']);
    }


    public function edit(Client_information $id) {
        return view('pages.config.modifier_client', ['info_client' => $id]);
    }

   
    public function update(Request $request, Client_information $client_information)
    {
        //validation de données
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'site' => 'required',
            'nom_client' => 'required',
            'mobile' => 'required|min:10',
            'email' => 'required',
        ]);

        //mise à jour des données dans le base de donnée.
        $client_information->update([
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);


        // POST information de client au API/clietns si le client change les information. 
        $server_ip = info_serveur_mgmt::first()->IP_DNS;
        
        $post = HTTP::post($server_ip.'/api/update_client', [
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        $response = $post->json();
        return redirect('/config')->with('message', "Le client est mise à jour avec success dans le serveur client ".$response['message']);
        
        //return redirect('/config')->with('message', "vous avez actualisé les informations du client avec succes!.");
    }


}
