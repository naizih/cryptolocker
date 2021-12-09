<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HashFileModelController;
use App\Http\Controllers\ClientInformationController;

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



// Route pour afficher l'info de client à modifier.
Route::get('/modifier_client/{client_information}/modifier', [ClientInformationController::class, 'edit']);
//route pour modifier les information de client.
Route::PUT('/modifier_client/{client_information}', [ClientInformationController::class, 'update']);


//Route pour reouperier tous le donnée en format json.
Route::get('/table-fichier',[HashFileModelController::class, 'api_datashow']);


//Route::post('/fichier-appat', [HashFileModelController::class, 'storeX']);
Route::post('/ajouter-nouveau-fichier', [HashFileModelController::class, 'store']);
Route::post('/ajouter-client', [ClientInformationController::class, 'store']);


//Route::post('/bash', function(){ });
Route::get('/bash', function() {
    return response()->json(['success' => 'la fichier est ajouter avec succces.']);
});
Route::get('/bash1', [Kernel::class, 'schedule']);




//Tous les routes qui viens de laravel, pas de vuejs.
Route::get('/', [HashFileModelController::class, 'index']);
Route::post('/fichier-appat', [HashFileModelController::class, 'store_laravel']);
Route::delete('/delete/{id}', [HashFileModelController::class, 'destroy_laravel']);





//Route pour checker un fichier
Route::post('/check', [HashFileModelController::class, 'check']);


// dans laravel pour supprimer on utilise le methode delete mais ici j'ai utiliser le methode post 
Route::delete('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
//Route::post('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
Route::delete('supprimer_multiple', [HashFileModelController::class, 'destroy_multiple']);

