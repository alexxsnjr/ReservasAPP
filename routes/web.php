<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
});

// Admin rutas
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/admin', 'HomeController@index')->name('admin');


//Aulas
Route::get('/aulas/listar','AulasController@listar')->name('aulas.listar');
Route::get('/aulas/crear','AulasController@crear')->name('aulas.crear');
Route::post('/aulas/store','AulasController@store')->name('aulas.store');
Route::get('/aulas/{id}/editar','AulasController@editar')->name('aulas.editar');
Route::put('/aulas/{id}', 'AulasController@update')->name('aulas.update');
Route::delete('/aulas/{id}/borrar','AulasController@borrar')->name('aulas.borrar');
Route::post('/sacarPisos','AulasController@sacarPisos')->name('aulas.sacarPisos');


//XML AULAS
Route::get('/aulas/importar-xml','XMLController@aulas')->name('aulas.importarXML');
Route::post('/aulas/importar-xml','XMLController@importarAulas')->name('aulas.importar');
Route::post('/aulas/subir-xml','XMLController@subirAulas')->name('aulas.subirXML');