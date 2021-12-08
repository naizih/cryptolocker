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

Route::get('/', [HashFileModelController::class, 'index']);


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






//Route pour checker un fichier
Route::post('/check', [HashFileModelController::class, 'check']);


// dans laravel pour supprimer on utilise le methode delete mais ici j'ai utiliser le methode post 
Route::delete('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
//Route::post('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
Route::delete('supprimer_multiple', [HashFileModelController::class, 'destroy_multiple']);

//pour supprimer une seule ligne.
//Route::delete('/suppri/{id}', [HashFileModelController::class, 'destroy']);






/*
Route::get('/verif', function() {
    return "http://192.168.141.207:8000/api/connexion";
});
*/