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

Route::post('login' , 'Api\AuthenticateController@authenticate')->name('login');
Route::post('user' , 'Api\AuthenticateController@getUser')->name('user');


Route::group([
    'namespace' =>  'Api',
    'middleware' => 'jwt.auth',
    ],
    function () {

        Route::get('tipos' , 'GetInfoController@getTipo');
        Route::get('equipamiento' , 'GetInfoController@getEquipamiento');
        Route::post('reservar.vue' , 'ReservaController@comprobarDisponibilidad');


    });



