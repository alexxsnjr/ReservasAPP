<?php

namespace App\Http\Controllers\Api;

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

        $aulas = DB::table('aulas')
            ->where('aulas.tipo', '=', $request->tipo)
            ->where('aulas.aforo', '>=', $request->aforo)
            ->get();

        //dd($aulas);
        return response()->json(compact('aulas'));
    }
}