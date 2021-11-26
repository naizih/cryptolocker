<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HashFileModelController;

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

Route::post('/fichier-appat', [HashFileModelController::class, 'store']);

// dans laravel pour supprimer on utilise le methode delete mais ici j'ai utiliser le methode post 
Route::post('/supprimer/{id}', [HashFileModelController::class, 'destroy']);
Route::delete('/suppri/{id}', [HashFileModelController::class, 'destroy']);


//try in place of api
Route::get('/table-fichier',[HashFileModelController::class, 'api_datashow']);



/*
Route::get('/verif', function() {
    return "http://192.168.141.207:8000/api/connexion";
});
*/