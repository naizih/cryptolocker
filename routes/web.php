<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HashFileModelController;
use App\Http\Controllers\ClientInformationController;
use App\Http\Controllers\ConfigController;              // appeler à la page de configuration de model config.
use App\Http\Controllers\info_serveur_mgmtController;
use App\Http\Controllers\TempsScriptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('accueil');
});
*/






//Route pour reouperier tous le donnée en format json.
Route::get('/table-fichier',[HashFileModelController::class, 'api_datashow']);


//Route::post('/fichier-appat', [HashFileModelController::class, 'storeX']);
//Route::post('/ajouter-nouveau-fichier', [HashFileModelController::class, 'store']);



//Route::post('/bash', function(){ });
Route::get('/bash', function() {
    return response()->json(['success' => 'la fichier est ajouter avec succces.']);
});
Route::get('/bash1', [Kernel::class, 'schedule']);




//Tous les routes qui viens de laravel, pas de vuejs.
Route::get('/', [HashFileModelController::class, 'index']);         // route vers la page accueil
Route::get('accueil', [HashFileModelController::class, 'index']);   // route vers la page accueil
//Route::post('/fichier-appat', [HashFileModelController::class, 'store_laravel']);       //sauvgardé le fichier 
Route::delete('supprimer_multiple_laravel', [HashFileModelController::class, 'destroy_multiple_laravel']);







//Tous les requet viens du ou vers page config 
Route::get('/connected', [ConfigController::class, 'verification_de_connexion']);       // verification de connexion



// Route vers le controlleur Clientinformation
Route::get('/config', [ClientInformationController::class, 'index']);           // 
Route::get('/modifier_client/{id}/modifier', [ClientInformationController::class, 'edit']);     // Route pour afficher l'info de client à modifier.
Route::PUT('/modifier_client/{client_information}', [ClientInformationController::class, 'update']);        //route pour modifier les information de client.
Route::post('/ajouter-client', [ClientInformationController::class, 'store']);              // sauvgardé les info de client dans la base de données.


// Route vers le controlleur info_serveur_mgmt
Route::get('/config/info_ser_mgmt', [info_serveur_mgmtController::class, 'index']);             //
Route::get('/modifier_serveur_info/{id}/modifier', [info_serveur_mgmtController::class, 'edit']);     // Route pour afficher l'info de client à modifier.
Route::post('/config/ajouter_info_serveur', [info_serveur_mgmtController::class, 'store']);              // sauvgardé les info de serveur dans la base de données.
Route::PUT('/modifier_serveur_info/{info_serveur}', [info_serveur_mgmtController::class, 'update']); 


// Route vers le configuration de temps de script
Route::get('/config/variable_temps_script', [TempsScriptController::class, 'index']);           // afficher la page config.
Route::get('/modifier_temps/{id}/modifier', [TempsScriptController::class, 'edit']);
Route::post('/config/ajouter_temps_script', [TempsScriptController::class, 'store']); 
Route::PUT('/update_temps/{temps}', [TempsScriptController::class, 'update']); 




Route::get('/config/info_ser_partage', [ConfigController::class, 'server_partage']);











//route pour selectioner le fichier 
Route::get('choisir_fichier_appat', [HashFileModelController::class, 'select_file']);
Route::post('/ajouter-nouveau-fichier', [HashFileModelController::class, 'store']);



// Route vers la page Ajouter_fichier_appat

/*
Route::get('/ajouter_fichier_appat', function(){
    
    return view('pages.ajouter_fichier_appat');
});  
*/

//Route::get('ajouter_fichier_appat', [HashFileModelController::class, 'select_file']);
//Route::get('ajouter_fichier_appat/{folder}', [HashFileModelController::class, 'select_file']);








//Route pour checker un fichier
Route::post('/check', [HashFileModelController::class, 'check']);


Route::post('/check_supprimer', [HashFileModelController::class, 'check_supprimer']);






/* pour vue.js
// dans laravel pour supprimer on utilise le methode delete mais ici j'ai utiliser le methode post 
Route::delete('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
//Route::post('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
Route::delete('supprimer_multiple', [HashFileModelController::class, 'destroy_multiple']);
*/
