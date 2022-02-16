<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HashFileModelController;
use App\Http\Controllers\ClientInformationController;
use App\Http\Controllers\info_serveur_mgmtController;
use App\Http\Controllers\TempsScriptController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SrvPartageController;

use App\Http\Controllers\UtilisateursController;



//Route pour recuperer tous les données en format json.
//Route::get('/table-fichier',[HashFileModelController::class, 'api_datashow']);


use Illuminate\Support\Facades\Auth;
use App\Models\User;


$user_table = User::all();
$count = $user_table->count();




//'register' => $count == 0 || Auth::user  ? true : false , // Registration Routes...
Auth::routes([
    'register' => $count == 0 ? true : false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);




//Route::get('/reg', [HashFileModelController::class, 'test'])->name('test_try');


Route::name('user.')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //Tous les routes qui viens de laravel, pas de vue.js.
    Route::get('/', [HashFileModelController::class, 'index']);         // route vers la page accueil
    Route::get('accueil', [HashFileModelController::class, 'index'])->name('accueil');   // route vers la page accueil

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function(){

        
        //Tous les requets viens et qui part de la page config 
        Route::get('/connected', [ClientInformationController::class, 'verification_de_connexion']);       // verification de connexion

        // Route vers le controlleur qui a les informations du client "Clientinformation"
        Route::get('/config', [ClientInformationController::class, 'index'])->name('config');           // 
        Route::get('/modifier_client/{id}/modifier', [ClientInformationController::class, 'edit']);     // Route pour afficher l'info du client à modifier.
        Route::PUT('/modifier_client/{client_information}', [ClientInformationController::class, 'update']);        //route pour actualiser les informations du client.
        Route::post('/ajouter-client', [ClientInformationController::class, 'store']);              // sauvgarder les informations du client dans la base de données.

        // Route vers le controlleur inormations du serveur de management "info_serveur_mgmt"
        Route::get('/config/info_ser_mgmt', [info_serveur_mgmtController::class, 'index'])->name('config-serv-mgmt');             //
        Route::get('/modifier_serveur_info/{id}/modifier', [info_serveur_mgmtController::class, 'edit']);     // Route pour afficher les informations du serveur management.
        Route::post('/config/ajouter_info_serveur', [info_serveur_mgmtController::class, 'store']);              // Route pour sauvegarder les informations du serveur management dans la base de données.
        Route::PUT('/modifier_serveur_info/{info_serveur}', [info_serveur_mgmtController::class, 'update']);  ///route pour actualiser les informations du serveur management

        // Route vers la page de configuration du temps de check dans script
        Route::get('/config/variable_temps_script', [TempsScriptController::class, 'index'])->name('config-script-time');           // afficher la page config.
        Route::get('/modifier_temps/{id}/modifier', [TempsScriptController::class, 'edit']);            //route pour changer le temps de check
        Route::post('/config/ajouter_temps_script', [TempsScriptController::class, 'store']);           //route pour sauvegarder la modification du temps
        Route::PUT('/update_temps/{temps}', [TempsScriptController::class, 'update']);                      //route pour actualiser le temps

        // Route pour utiliser après.
        Route::get('/config/srv-partage', [SrvPartageController::class, 'index'])->name('config-info-srv-partage');
        Route::get('/config/srv-partage/ajouter', [SrvPartageController::class, 'create'])->name('afficher-ajouter-srv-partage');   // CREATE
        Route::post('/config/srv-partage/ajouter', [SrvPartageController::class, 'store'])->name('ajouter-srv-partage');            // STORE
        Route::delete('/config/srv-partage/delete', [SrvPartageController::class, 'destroy'])->name('supprimer-srv-partage');       // DEELTE
        

        //route pour selectioner le fichier 
        Route::get('choisir_fichier_appat', [HashFileModelController::class, 'select_file']);   // Route pour iteration de fichier
        Route::post('/ajouter-nouveau-fichier', [HashFileModelController::class, 'store'])->name('ajouter-nouveau-fichier');       // Rout pout ajouter le hash de nouveau fichier dans la base de données.

        // Route pour checker ou supprimer le fichier, il prendre tous les box sélectioner et verifé si le boutton cliquée est check ou supprimer, et il façe la tache correspondance. 
        Route::post('/check_supprimer', [HashFileModelController::class, 'check_supprimer']);



         // Route pour gestion des utilisateurs ( CRUD )
         Route::get('/utilisateurs', [UtilisateursController::class, 'index'])->name('utilisateur');
         Route::get('/utilisateur/ajouter', [UtilisateursController::class, 'create'])->name('utilisateur-register');
         Route::post('/utilisateur/ajouter', [UtilisateursController::class, 'store'])->name('nouveau-utilisateur');
         Route::get('/utilisateur/{id}/modifier', [UtilisateursController::class, 'edit'])->name('modifier-utilisateur', 'id');
         Route::post('/utilisateur/update', [UtilisateursController::class, 'update'])->name('utilisateur-update');
         Route::post('/utilisateur/{id}/supprimer', [UtilisateursController::class, 'destroy'])->name('utilisateur-delete', 'id');
         // IS Admin finished

         Route::get('/utilisateur/{id}/profile', [UtilisateursController::class, 'show'])->name('utilisateur-profile', 'id');

        

        // Route pour se déconnecter
        Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    });
});

