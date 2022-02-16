<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UtilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $users = User::all();
        if (Auth::user()->email == $users->first()->email ){
            return view('utilisateurs.afficher_utilisateurs', ['users' => $users]);
        }else{
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::first();
        if (Auth::user()->email == $users->email ){
            return view('utilisateurs.creer_utilisateurs');
        }else{
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
        if (Auth::user()->email == $users->first()->email ){
            $validator = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|unique:users|email|max:255',
                'password' => 'required|between:8,255|confirmed',
                'password_confirmation' => 'required|same:password',
            ]);


            $user->create([
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/utilisateurs')->with('message', "Vous avez crée avec succès le nouveau utilisateur.");
        }else{
            abort(401);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $users = User::first();
        if (Auth::user()->email == $users->email ){
            $user = User::whereId($id)->first();
            return view('utilisateurs.modifier_utilisateurs', ['user' => $user]);
        }else{
            abort(401);
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if (Auth::user()->email == $users->first()->email ){
            if($request->password == NULL) {
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|max:100',
                ]);
            }else{
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|max:100',
                    'password' => 'required|between:8,255|confirmed',
                    'password_confirmation' => 'required|same:password',
                ]);
            }
            

            $pass = $user->find($request->id)->password;

            if($request->password != null){
                $pass = Hash::make($request->password);
            }else{
                $pass = $user->find($request->id)->password;
            }
            
            
            $user = $user->find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $pass;
            $user->save();


            return redirect('/utilisateurs')->with('message', "Vous avez Modifé avec succès le utilisateur ".$request->name);
        }else{
            abort(401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        if (Auth::user()->email == $users->first()->email ){
           // supprimer la ligne correspondance dans le base de données.
           $user->where('id', $id)->delete();        
           return redirect('/utilisateurs')->with('message', "Le utilisateur est supprimer avec succès.");
        }else{
            abort(401);
        }
    }
}
