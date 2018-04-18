<?php

namespace App\Http\Controllers\Api;

use App\Aula;
use App\Equipamiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class GetInfoController extends Controller
{
    public function getTipo()
    {

        $tipos = Aula::select('tipo')->distinct()->get();

        return response()->json(compact('tipos'));
    }

    public function getEquipamiento()
    {
        $equipamientos = Equipamiento::select('nombre')->distinct()->get();

        return response()->json(compact('equipamientos'));
    }
}
