<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {

        $aulas = DB::table('aulas')->leftJoin('equipamientos', 'aulas.id', '=', 'equipamientos.aula_id')
            ->where('aulas.id', '=', 'equipamientos.aula_id')
            ->where('aulas.tipo', '=', $request->tipo)
            ->where('aulas.aforo', '>=', $request->aforo)
            ->whereRaw('aulas.id not in ( SELECT aula_id FROM reservas WHERE fecha = "2018-04-25 00:00:00" AND turno = "'.$request->turno.'" AND hora = '.$request->hora.' )')
            ->get();


        return response()->json(compact('aulas'));
    }
}
