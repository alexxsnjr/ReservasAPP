<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {

        dd($request);

        $aulas = DB::table('aulas')
            ->where([
                ['tipo', '=' ,$request->tipo],
                ['tipo', '=' ,$request->tipo],
                ['tipo', '=' ,$request->tipo],
                ['tipo', '=' ,$request->tipo],
                ])
            ->get();


        return response()->json(compact('aulas'));
    }
}
