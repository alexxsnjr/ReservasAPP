<?php

namespace App\Http\Controllers\Api;

use App\Aula;
use App\Centro;
use App\ExcepcionHorario;
use App\Horario;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReservaController extends Controller
{

    public function comprobarDisponibilidad(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'fecha'=>'required',
            'aforo'=>'required',
            'turno'=>'required',
            'hora'=>  'required|integer',
            'tipo'=>'required',
        ]);

        $fecha = Carbon::parse($request->fecha)->addDay()->format('Y/m/d');

        $dia_semana = Carbon::parse($fecha)->dayOfWeek;

        $aulas = DB::select('SELECT aulas.id as ID, aulas.nombre as nombre from aulas, equipamientos where aulas.id = equipamientos.aula_id and aulas.tipo = "'.$request->tipo.'" and aulas.aforo >= "'.$request->aforo.'" and equipamientos.nombre = "'.$request->requerimientos[0].'" and aulas.id not in (SELECT aula_id FROM reservas WHERE fecha = "'.$fecha.'" AND turno = "'.$request->turno.'" AND hora = "'.$request->hora.'") and (aulas.id not in (SELECT aula_id FROM horarios WHERE dia_semana = "'.$dia_semana.'" AND turno = "'.$request->turno.'" AND hora = "'.$request->hora.'") OR aulas.id in (SELECT aula_id FROM excepcion_horarios WHERE fecha = "'.$fecha.'" AND turno = "'.$request->turno.'" AND hora = "'.$request->hora.'"))');

        return response()->json(compact('aulas'));

    }


    public function  index($user){

        $reservas = Reserva::join('aulas', 'aulas.id', '=' , 'reservas.aula_id')
                    ->where('reservas.fecha' , '>=' , Carbon::now()->format('Y/m/d'))
                    ->where('reservas.profesor_id', '=' , $user)
                    ->select( 'reservas.*' , 'aulas.nombre' , 'aulas.aforo')
                    ->get();

        return response()->json(compact('reservas'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'aula' => 'required|integer',
            'fecha'=>'required',
            'turno'=>'required',
            'hora'=>  'required',
        ]);

        $user = JWTAuth::toUser($request->token);

        $fecha= Carbon::parse($request->fecha)->addDay()->format('Y/m/d');

        $dia_semana = Carbon::parse($fecha)->dayOfWeek;

        //Comprobamos si tiene alguna reserva ya en ese horario y si es así la eliminamos
        Reserva::where('profesor_id',$user->id)->where('fecha',$fecha)->where('turno',$request->turno)->where('hora',$request->hora)->delete();

        //Comprobamos si tiene un aula asignada para ese horario y si es asi lo añadimos a excepciones de horario
        $aulaAsignada = Horario::where('profesor_id',$user->id)
                                ->where('dia_semana',$dia_semana)
                                ->where('turno',$request->turno)
                                ->where('hora',$request->hora)->first();

        if(isset($aulaAsignada) && !empty($aulaAsignada)){

            $excepcionHorario = new ExcepcionHorario;
            $excepcionHorario->aula_id = $aulaAsignada->aula_id;
            $excepcionHorario->fecha = $fecha;
            $excepcionHorario->turno = $request->turno;
            $excepcionHorario->hora = $request->hora;
            $excepcionHorario->save();

        }

        $reserva = new Reserva;
        $reserva->profesor_id = $user->id;
        $reserva->aula_id = $request->aula;
        $reserva->fecha = $fecha;
        $reserva->turno = $request->turno;
        $reserva->hora = $request->hora;
        $reserva->save();

        $centro=Centro::all()->first();

        $datos = [
            'reserva' => $reserva,
        ];

        Mail::send('email.formato-reserva', $datos, function ($mensaje) use ($user,$centro) {

            $mensaje->from($centro->email, 'Reserva de aulas - '.$centro->nombre);
            $mensaje->to($user->email, $user->name)->subject('Reserva realizada!');

        });

        return response()->json($reserva,200);
    }

    public function delete($id)
    {
        $reserva = Reserva::find($id);

        $reserva->delete();
        return response()->json('Delete', 200);
    }

}