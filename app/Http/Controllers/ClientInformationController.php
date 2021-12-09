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
        return view('pages.modifier_client');
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

   
    public function store(Request $request) {
        //
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'nom_client' => 'required',
            'mobile' => 'string|min:8',
            'email' => 'required',
        ]);


        Client_information::create([
            'nom_entreprise' =>  request('nom_entreprise'),
            'nom_client' => request('nom_client'),
            'mobile' => request('mobile'),
            'email' => request('email'),
        ]);

        return redirect('/');

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
    }



    public function edit(Client_information $client_information) {
        return view('pages.modifier_client', ['info_client' => $client_information]);
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
        //validation de données
        $validator = $request->validate([
            'nom_entreprise' => 'required',
            'nom_client' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        //mise à jour les données dans le base de donnée.
        $client_information->update([
            'nom_entreprise' =>  request('nom_entreprise'),
            'nom_client' => request('nom_client'),
            'mobile' => request('mobile'),
            'email' => request('email'),
        ]);

        return redirect('/');
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
