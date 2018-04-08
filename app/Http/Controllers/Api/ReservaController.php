<?php

namespace App\Http\Controllers\Api;

use App\Aula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservaController extends Controller
{
    public function comprobarDisponibilidad(Request $request)
    {
        $aulas = Aula::where('tipo', '=' ,$request->tipo)->get();


        return response()->json(compact('aulas'));
    }
}
