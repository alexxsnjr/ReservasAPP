<?php

namespace App\Http\Controllers\Api;

use App\Aula;
use App\Equipamiento;
use App\User;
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

    public function checkEmail($email){
        $user = User::where('email',$email)->get();

        if(count($user) > 0){
            return response('false', 200);
        }else {
            return response('true', 200);
        }
    }
}
