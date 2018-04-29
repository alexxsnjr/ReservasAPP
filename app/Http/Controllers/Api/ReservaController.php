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
            ->where('aulas.tipo', '=', 'normal')
            ->where('aulas.aforo', '>=', '2')
            ->whereRaw('aulas.id not in ( SELECT aula_id FROM reservas WHERE fecha = "2018-04-25" AND turno = "mañana" AND hora = 1 )')
            ->get();


        return response()->json(compact('aulas'));
    }
}