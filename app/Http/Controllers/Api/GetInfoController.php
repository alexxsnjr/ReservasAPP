<?php

namespace App\Http\Controllers\Api;

use App\Aula;
use App\Equipamiento;
use App\Profesor;
use App\User;
use Carbon\Carbon;
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

    public function checkEmail($email)
    {

        $user = Profesor::where('email',$email)->get();

        if(count($user) > 0){
            return response('false', 200);
        }else {
            return response('true', 200);
        }

    }

    public function checkDate(Request $request)
    {

        $fecha = Carbon::parse($request->date)->addDay()->format('Y/m/d');

        if(Carbon::parse($fecha)->isWeekend() || $fecha<Carbon::now()->format('Y/m/d')){
            return response()->json('false');
        }else{
            return response()->json('true');
        }

    }

}
