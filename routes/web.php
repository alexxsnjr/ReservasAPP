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

Route::get('/aulas-disponibles', function () {
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
Route::get('/aulas/{id}/ver','AulasController@ver')->name('aulas.ver');
Route::post('/sacarPisos','AulasController@sacarPisos')->name('aulas.sacarPisos');


//Equipamientos
Route::get('/aulas/{aula_id}/equipamiento-crear','EquipamientosController@crear')->name('equipamiento.crear');
Route::post('/aulas/{aula_id}/equipamiento-store','EquipamientosController@store')->name('equipamiento.store');
Route::get('/aulas/{id}/equipamiento-editar','EquipamientosController@editar')->name('equipamiento.editar');
Route::put('/aulas/{id}/equipamiento-editar', 'EquipamientosController@update')->name('equipamiento.update');
Route::delete('/aulas/{id}/equipamiento-borrar','EquipamientosController@borrar')->name('equipamiento.borrar');


//XML
Route::get('/importar-xml','XMLController@index')->name('importarXML');
Route::post('/subir-xml','XMLController@subirArchivo')->name('subirXML');
Route::post('/importar-xml','XMLController@importar')->name('importar');


//IES
Route::get('/asistente','IesController@asistente')->name('asistente');