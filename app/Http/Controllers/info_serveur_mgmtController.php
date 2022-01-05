<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\info_serveur_mgmt;
use Illuminate\Support\Facades\Session;



class info_serveur_mgmtController extends Controller {

    //configuration des information de serveur management
    public function index() {
        $server_info = info_serveur_mgmt::first();
        return view('pages.config.information_serveur_management', ['info_serveur' => $server_info]);   
    }


    public function store(Request $request){


        // on sauvgarde les données de serveur
        $validator = $request->validate([
            'adresse_ip' => 'required',
            'DNS' => 'required',
        ]);
        
        info_serveur_mgmt::create([
            'IP' =>  request('adresse_ip'),
            'domain_name' =>  request('DNS'),
            'port' => '81',
        ]);
        return redirect('/config/info_ser_mgmt')->with('message', "l'adresse IP et DNS et ajouter avec success le port utilisé est 81");
    }

    
    public function edit(info_serveur_mgmt $id) {
        return view('pages.config.modifier_info_serveur', ['info_serveur' => $id]);
    }

    
    public function update(Request $request, info_serveur_mgmt $info_serveur) {

        // on sauvgarde les données de serveur
        $validator = $request->validate([
            'adresse_ip' => 'required',
            'DNS' => 'required',
        ]);
        
        $info_serveur->update([
            'IP' =>  request('adresse_ip'),
            'domain_name' =>  request('DNS'),
        ]);

    
        return redirect('/config/info_ser_mgmt')->with('message', "Fonction de modification march bien!");
    }
}
