<?php

namespace App\Http\Controllers;

use App\Models\Client_information;
use Illuminate\Http\Request;

class ClientInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
        //validation de données avant le sauvgarder.
        
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'nom_client' => 'required',
            'mobile' => 'string|min:8',
            'email' => 'required',
        ]);

       
        /*
        Client_information::create([
            'nom_entreprise' =>  Input::get('nom_entreprise'),
            'nom_client' => Input::get('nom_client'),
            'mobile' => Input::get('mobile'),
            'email' => Input::get('email'),
        ]);
        */
    
        if ($validator->fails()) {
            //$errors = $validator->errors()->first();
            return response()->json(['error' => $validator->errors()], 401);
        }
            /*
            $d = [];
            foreach ($messages->all() as $message){
                array_push($d, $message);
            }
            return response()->json(['error' => $d]);
            */
        //}else{
            return response()->json(['success' => 'la fichier est ajouter avec succces.']);
            dd($request);
       // }
    
    
        //dd($request);
        //return response()->json(['success' => 'la fichier est ajouter avec succces.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client_information  $client_information
     * @return \Illuminate\Http\Response
     */
    public function show(Client_information $client_information)
    {
        //
        $data = Client_information::all();

        return response()->json([
            'client_info' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client_information  $client_information
     * @return \Illuminate\Http\Response
     */
    public function edit(Client_information $client_information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client_information  $client_information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client_information $client_information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client_information  $client_information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client_information $client_information)
    {
        //
    }
}
