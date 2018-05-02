<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'fecha'=>'required',
            'aforo'=>'required',
            'turno'=>'required',
            'hora'=>  'required',
            'tipo'=>'required',
        ]);

        $fecha= Carbon::parse($request->fecha)->format('Y-m-d');
        //dd($fecha);

        $aulas = DB::select('SELECT aulas.id as ID, aulas.nombre as nombre from aulas, equipamientos where aulas.id = equipamientos.aula_id and aulas.tipo = "'.$request->tipo.'" and aulas.aforo >= "'.$request->aforo.'" and equipamientos.nombre = "'.$request->requerimientos[0].'" and aulas.id not in (SELECT aula_id FROM reservas WHERE fecha = "'.$fecha.'" AND turno = "'.$request->turno.'" AND hora = "'.$request->hora.'")');

        return response()->json(compact('aulas'));
    }
}