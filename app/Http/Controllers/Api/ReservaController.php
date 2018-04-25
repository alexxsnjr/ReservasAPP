<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {

        $aulas = DB::table('aulas')->leftJoin('reservas', 'aulas.id', '=', 'reservas.aula_id')
            ->where([
                ['tipo', '=' ,$request->tipo],
                ['aforo', '>=' ,$request->aforo]
            ])
            ->get();


        return response()->json(compact('aulas'));
    }
}
