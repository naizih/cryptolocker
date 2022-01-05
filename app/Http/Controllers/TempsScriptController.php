<?php

namespace App\Http\Controllers;

use App\Models\Temps_script;
use Illuminate\Http\Request;

class TempsScriptController extends Controller {

    public function index()
    {
        $variable_temps = Temps_script::first();
        return view('pages.config.temps_script', ['temps' => $variable_temps]);   
    }

    public function store(Request $request)
    {
        // on sauvgarde les données de serveur
        $validator = $request->validate([
            'temps_check' => 'required',
            'temps_envoie_server_mgmt' => 'required',
        ]);
        
        Temps_script::create([
            'temps_check' =>  request('temps_check'),
            'temps_envoie_server_mgmt' =>  request('temps_envoie_server_mgmt'),
        ]);
        return redirect('/config/variable_temps_script');
    }

    public function edit(Temps_script $id)
    {
        //dd($id);
        return view('pages.config.modifier_temps_script',  ['temps' => $id]);
    }

    public function update(Request $request, Temps_script $temps)
    {
        // on n'a pas besoin de validation de input.
        /*
        $validator = $request->validate([
            'temps_check' => 'required',
            'server_time' => 'required',
        ]);
        */

        $temps->update([
            'temps_check' =>  request('temps_check'),
            'temps_envoie_server_mgmt' =>  request('server_time'),
        ]);
        return redirect('/config/variable_temps_script');

    }

}
