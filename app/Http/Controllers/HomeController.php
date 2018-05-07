<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Profesor;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('primerlogin');
    }

    public function index()
    {
        $fechaHoy = Carbon::now()->format('Y-m-d');

        $totalReservas = Reserva::where('fecha','>=',$fechaHoy)->get();
        $profesores = Profesor::all();

        if(count($totalReservas)>=1) {

            $porcentajeDiario = count(Reserva::where('fecha', $fechaHoy)->get()) / count($totalReservas) * 100;

        }else{

            $porcentajeDiario = 0;

        }

        $aulas = Aula::all();

        return view('admin/admin')->with('reservas',count($totalReservas))
                                        ->with('profesores',count($profesores))
                                        ->with('reservasHoy',$porcentajeDiario)
                                        ->with('aulas',count($aulas));

    }

}
