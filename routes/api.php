<?php

use Illuminate\Http\Request;
use App\User;

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

Route::get('/', function () {
    return response()->json([
        'status'=>'ok',
         'msj'=>'Bienvenid@ a nuestra API , para mayor conocimiento de nuestra API  favor dirigirse a la ruta '.env('APP_URL')
 ], 200);
 });
Route::post('login', 'Api\LoginController@iniciarsesion');
Route::post('logout', 'Api\LoginController@cerrarsesion');

Route::group(['middleware' => ['jwt.autenticacion']], function() {
    Route::get('/test', function () {
         return response()->json([
            'usuarios'=>User::all()
            ]
            , 200);
    });
});
