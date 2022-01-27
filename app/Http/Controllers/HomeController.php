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
        //return view('accueil');

        return redirect('/');

    }



    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
