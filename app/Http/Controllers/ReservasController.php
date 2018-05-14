<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Profesor;
use App\Reserva;
use Illuminate\Http\Request;

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

        $reserva = new Reserva;
        $reserva->profesor_id = $request->profesor_id;
        $reserva->aula_id = $request->aula_id;
        $reserva->fecha = $request->fecha;
        $reserva->turno = $request->turno;
        $reserva->hora = $request->hora;
        $reserva->save();

        return redirect()->back()->with('success','Reserva hecha con exito!');

    }

    public function info(Request $request)
    {

        $reserva = Reserva::find($request->reserva_id);
        $reserva->profesor;
        $reserva->aula;

        return response()->json($reserva);

    }

}
