<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Profesor;

class AsistenteController extends CentroController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('asistente')->only('index','datosCentro');
    }

    public function index()
    {
        return view('admin/asistente/index');
    }

    public function datoscentro()
    {
        return view('admin/asistente/datos');
    }

    public function personalizarcentro()
    {
        return view('admin/asistente/personalizar');
    }

    public function importarDatos()
    {
        return view('admin/asistente/importarDatos');
    }

    public function consultarDatos()
    {

        $aulas = Aula::all();
        $usuarios = Profesor::all();

        $respuesta=[];

        if(count($aulas)>0){

            $respuesta["aulas"]='1';

        }
        if(count($usuarios)>0){

            $respuesta["usuarios"]='1';

        }

        return response()->json($respuesta);

    }

    public function terminar()
    {
        return view('admin/asistente/final');
    }
}
