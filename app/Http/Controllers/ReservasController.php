<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Centro;
use App\ExcepcionHorario;
use App\Horario;
use App\Profesor;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $profesores = Profesor::all();
        $aulas = Aula::orderBy('tipo')->get();
        $reservas = Reserva::all();

        return view('admin/reservas/index')->with('profesores',$profesores)->with('aulas',$aulas)->with('reservas',$reservas);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'profesor_id' => 'required|integer',
            'aula_id' => 'required|integer',
            'fecha'=>'required|date',
            'turno'=>'required|in:tarde,manana',
            'hora'=>  'required|integer',
        ]);

        $comprobarReserva = Reserva::where('aula_id',$request->aula_id)
                                    ->where('turno',$request->turno)
                                    ->where('fecha',$request->fecha)
                                    ->where('hora',$request->hora)->get();

        if(count($comprobarReserva)>0){

            return redirect()->back()->with('danger','Ese aula ya se encuentra reservada con esos parametros.')->withInput();

        }

        $dia_semana = Carbon::parse($request->fecha)->dayOfWeek;

        //Comprobamos si tiene alguna reserva ya en ese horario y si es así la eliminamos
        Reserva::where('profesor_id',$request->profesor_id)->where('fecha',$request->fecha)->where('turno',$request->turno)->where('hora',$request->hora)->delete();

        //Comprobamos si tiene un aula asignada para ese horario y si es asi lo añadimos a excepciones de horario
        $aulaAsignada = Horario::where('profesor_id',$request->profesor_id)
            ->where('dia_semana',$dia_semana)
            ->where('turno',$request->turno)
            ->where('hora',$request->hora)->first();

        if(isset($aulaAsignada) && !empty($aulaAsignada)){

            $excepcionHorario = new ExcepcionHorario;
            $excepcionHorario->aula_id = $aulaAsignada->aula_id;
            $excepcionHorario->fecha = $request->fecha;
            $excepcionHorario->turno = $request->turno;
            $excepcionHorario->hora = $request->hora;
            $excepcionHorario->save();

        }

        $reserva = new Reserva;
        $reserva->profesor_id = $request->profesor_id;
        $reserva->aula_id = $request->aula_id;
        $reserva->fecha = $request->fecha;
        $reserva->turno = $request->turno;
        $reserva->hora = $request->hora;
        $reserva->save();

        $centro=Centro::all()->first();

        $datos = [
            'reserva' => $reserva,
        ];

        Mail::send('email.formato-reserva', $datos, function ($mensaje) use ($reserva,$centro) {

            $mensaje->from($centro->email, 'Reserva de aulas - '.$centro->nombre);
            $mensaje->to($reserva->profesor->email, $reserva->profesor->name)->subject('Reserva realizada!');

        });

        return redirect()->back()->with('success','Reserva realizada con exito!');

    }

    public function borrar(Request $request){

        $reserva = Reserva::find($request->id);

        $reserva->delete();

        return redirect()->back()->with('success', 'Reserva eliminada!');

    }

    public function info(Request $request)
    {

        $reserva = Reserva::find($request->reserva_id);
        $reserva->profesor;
        $reserva->aula;

        return response()->json($reserva);

    }

}
