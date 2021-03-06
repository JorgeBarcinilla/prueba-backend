<?php

use Illuminate\Http\Request;

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

//Esta es una ruta de tipo resource que asigna automaticamente las rutas tipicas CRUD
Route::post('user/filter', 'UserController@filterResource');
Route::apiResource('user', 'UserController');
Route::apiResource('country', 'CountryController')->only([
    'index'
]);

