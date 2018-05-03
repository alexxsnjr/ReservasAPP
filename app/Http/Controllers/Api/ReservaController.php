<?php

namespace App\Http\Controllers\Api;

use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReservaController extends Controller
{

    public function comprobarDisponibilidad(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'fecha'=>'required',
            'aforo'=>'required',
            'turno'=>'required',
            'hora'=>  'required|integer',
            'tipo'=>'required',
        ]);

        $fecha= Carbon::parse($request->fecha)->format('Y-m-d');
        //dd($fecha);

        $aulas = DB::select('SELECT aulas.id as ID, aulas.nombre as nombre from aulas, equipamientos where aulas.id = equipamientos.aula_id and aulas.tipo = "'.$request->tipo.'" and aulas.aforo >= "'.$request->aforo.'" and equipamientos.nombre = "'.$request->requerimientos[0].'" and aulas.id not in (SELECT aula_id FROM reservas WHERE fecha = "'.$fecha.'" AND turno = "'.$request->turno.'" AND hora = "'.$request->hora.'")');

        return response()->json(compact('aulas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'aula' => 'required|integer',
            'fecha'=>'required',
            'turno'=>'required',
            'hora'=>  'required',
        ]);

        $user = JWTAuth::toUser($request->token);
        $fecha= Carbon::parse($request->fecha)->format('Y-m-d');

        $reserva = new Reserva;
        $reserva->profesor_id = $user->id;
        $reserva->aula_id = $request->aula;
        $reserva->fecha = $fecha;
        $reserva->turno = $request->turno;
        $reserva->hora = $request->hora;
        $reserva->save();

        return response()->json($reserva,200);
    }

}