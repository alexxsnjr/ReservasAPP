<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {

        $aulas = DB::table('aulas')
            ->where('aulas.tipo', '=', $request->tipo)
            ->where('aulas.aforo', '>=', $request->aforo)
            ->get();

        //dd($aulas);
        return response()->json(compact('aulas'));
    }
}