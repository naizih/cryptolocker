<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//importer le controleur
use App\Http\Controllers\HashFileModelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// on peut utiliser cette methode pour recuperer les donnée 	
//Route::get('table-fichier', [HashFileModelController::class, 'api_datashow']);
