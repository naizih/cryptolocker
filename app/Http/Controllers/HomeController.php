<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client_information;
use App\Models\Hash_File_Model;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $data = Hash_File_Model::all();
        
        $info_client = Client_information::all();
        return view('accueil', ['information_client' => $info_client, 'table_fichier_hash' => $data]);
    }



    function logout(){
        Auth::guard('web')->logout();
        return redirect('/home');
    }
}
