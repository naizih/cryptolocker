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
            return redirect()->back()->with("fail", "Vous n'avez pas le droit.");
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
        if (Auth::user()->email == $user->first()->email ){
            $validator = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|unique:users|email|max:255',
                'password' => 'required|between:8,100|confirmed',
                'password_confirmation' => 'required|same:password',
            ],[
                'name.required' => 'Le nom doit être rempli. ',
                'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',

                'email.required' => 'Le mail doit être rempli.',
                'email.unique' => 'Le mail existe déja.',
                'email.email' => 'Le mail que vous avez écrie n\'est pas valide.',
                'email.max' => 'Le mail ene doit pas dépasser 255 caractères.',

                'password.required' => 'Le mot de passe doit être rempli.',
                'password.between' => 'Le mot de passe doit être 8-100 caractères.',
                'password.confirmed' => 'Le mot de passe de confirmation est différent du mot de passe.',

                'password_confirmation.required' => 'le mot de passe de confirmation doit être rempli .',
                'password_confirmation.same' => 'Le mot de passe de confirmation est différent du mot de passe.',

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
        $user = User::find($id);
        return view('utilisateurs.profile_utilisateur', ['utilisateur' => $user]);
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
        if (Auth::user()->email == $users->email || Auth::user()->id == $id ){
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
        $requested_user = $user->find($request->id)->email;

        if (Auth::user()->email == $user->first()->email || Auth::user()->email == $requested_user ){
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


            if (Auth::user()->email === $requested_user) {
                return redirect('/utilisateur/'.Auth::user()->id.'/profile')->with('message', "Vous avez Modifé avec succès le utilisateur ".$request->name);   
            }else{
                return redirect('/utilisateurs')->with('message', "Vous avez Modifé avec succès le utilisateur ".$request->name);
            }
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
        if (Auth::user()->email == $user->first()->email ){
           // supprimer la ligne correspondance dans le base de données.
           $user->where('id', $id)->delete();        
           return redirect('/utilisateurs')->with('message', "Le utilisateur est supprimer avec succès.");
        }else{
            abort(401);
        }
    }
}
