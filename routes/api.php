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

//LOGIN
Route::post('login' , 'Api\AuthenticateController@authenticate');
Route::get('checkemail/{email}', 'Api\GetInfoController@checkEmail');


Route::group([
    'namespace' =>  'Api',
    'middleware' => 'jwt.auth',
    ],
    function () {
        //INFO-
        Route::get('tipos' , 'GetInfoController@getTipo');
        Route::get('equipamiento' , 'GetInfoController@getEquipamiento');
        Route::post('validar-fecha' , 'GetInfoController@checkDate');

        //RESERVAS
        Route::post('reservar' , 'ReservaController@comprobarDisponibilidad');
        Route::post('doreserva' , 'ReservaController@store');
        Route::get('reservas/{user}' , 'ReservaController@index');
        Route::delete('reservas/{id}','ReservaController@delete');

        //USER
        Route::get('user/{token}' , 'UserController@index');
        Route::put('user/{id}' , 'UserController@update');
        Route::post('checkpassword' ,'UserController@checkPassword');
        Route::put('password/{id}' ,'UserController@updatePassword' );


    });
