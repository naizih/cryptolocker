<?php

namespace App\Http\Controllers;

use App\Models\Client_information;
use Illuminate\Http\Request;
use App\Models\info_serveur_mgmt;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Http;



class ClientInformationController extends Controller
{
   
    // on retourne notre information vers la page config et dans le page config on include le code html de info_client
    public function index() {
        $info_client = Client_information::all();
        return view('pages.config', ['information_client' => $info_client]);   

    }

    public function store(Request $request, Client_information $client ) {
        //
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'site' => 'required',
            'nom_client' => 'required',
            'mobile' => 'string|min:8',
            'email' => 'required',
        ]);


        $client->create([
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        //$server_ip = info_serveur_mgmt::first()->IP;
        //$server_port = '81';
        //dd($server_ip);

        /*
        $post = HTTP::post('192.168.141.174:81/api/update_client', [
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        //$post->send();

        $response = $post->json();
        return redirect('/config')->with('message', "Le client est ajouter avec success dans le serveur client ".$response['message']);
        */
        return redirect('/config')->with('message', "Le client est ajouter avec success!");

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

        //mise à jour les données dans le base de donnée.
        $client_information->update([
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);


        // POST information de client au API/clietns si le client change les information. 

        //$server_ip = info_serveur_mgmt::first()->IP;
        //$server_port = '81';
        //dd($server_ip);

        /*
        $post = HTTP::post('192.168.141.174:81/api/update_client', [
            'nom_entreprise' =>  $request->nom_entreprise,
            'site' =>  $request->site,
            'nom_client' => $request->nom_client,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);

        $response = $post->json();
        return redirect('/config')->with('message', "Le client est mise à jour avec success dans le serveur client ".$response['message']);
        */
        return redirect('/config')->with('message', "Le client est mise à jour avec success!.");
    }


}
