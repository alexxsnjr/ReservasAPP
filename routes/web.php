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


//Profesores
Route::get('/profesores/listar','ProfesorController@listar')->name('profesores.listar');
Route::get('/profesores/crear','ProfesorController@crear')->name('profesores.crear');
Route::post('/profesores/store','ProfesorController@store')->name('profesores.store');
Route::get('/profesores/{id}/editar','ProfesorController@editar')->name('profesores.editar');
Route::put('/profesores/{id}', 'ProfesorController@update')->name('profesores.update');
Route::delete('/profesores/{id}/borrar','ProfesorController@borrar')->name('profesores.borrar');
Route::get('/profesores/{id}/restaurar','ProfesorController@restaurarClave')->name('profesores.restaurarClave');


//XML
Route::get('/importar-xml','XMLController@index')->name('importarXML');
Route::post('/subir-xml','XMLController@subirArchivo')->name('subirXML');
Route::post('/importar-xml','XMLController@importar')->name('importar');


//ASISTENTE
Route::get('/asistente','AsistenteController@index')->name('asistente');
Route::get('/datos-centro','AsistenteController@datosCentro')->name('asistente.datosCentro');
Route::get('/personalizar-centro','AsistenteController@personalizarCentro')->name('asistente.personalizarCentro');
Route::get('/importar-datos','AsistenteController@importarDatos')->name('asistente.importarDatos');
Route::get('/consultardatos','AsistenteController@consultarDatos')->name('consultarDatos');
Route::get('/asistente-terminar','AsistenteController@terminar')->name('asistenteTerminar');


//CENTRO
Route::post('/datos-centro','CentroController@store')->name('datosCentro.store');
Route::put('/datos-centro/{id}','CentroController@anadirColor')->name('datosCentro.color');
Route::get('/recargarimagen','CentroController@recargarImagen')->name('recargarImagen');
Route::post('/subir-imagen','CentroController@subirImagen')->name('subirImagen');
Route::get('/editar-centro','CentroController@editar')->name('centro.editar');
Route::put('/editar-centro/{id}','CentroController@update')->name('centro.update');


