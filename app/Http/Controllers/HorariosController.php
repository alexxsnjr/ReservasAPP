<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Horario;
use Illuminate\Http\Request;

class HorariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function crear($profesor_id)
    {

        $aulas = Aula::all();
        return view('admin.profesores.horarios.crear')->with('profesor_id', $profesor_id)->with('aulas', $aulas);

    }

    public function store(Request $request,$profesor_id)
    {

        $this->validate($request, [
            'aula' => 'required',
            'dia' => 'required|integer',
            'hora' => 'required|integer',
            'turno' => 'required',
        ]);

        $comprobar_disponibilidad = Horario::where('aula_id',$request->aula)->where('dia_semana',$request->dia)->where('turno',$request->turno)
                                            ->where('hora',$request->hora)->get();

        if(count($comprobar_disponibilidad)>0){

            return redirect()->back()->with('danger', 'ESte horario ya esta asignado a algun profesor!');

        }

        $horario = new Horario;
        $horario->profesor_id = $profesor_id;
        $horario->aula_id = $request->aula;
        $horario->dia_semana = $request->dia;
        $horario->turno = $request->turno;
        $horario->hora = $request->hora;
        $horario->save();

        return redirect('/profesores/'.$profesor_id.'/ver-horario')->with('success', 'Horario añadido con exito!');

    }

    public function editar($id)
    {

        $horario = Horario::find($id);
        $aulas = Aula::all();

        return view('admin.profesores.horarios.editar')->with('horario', $horario)->with('aulas', $aulas);

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'aula' => 'required',
            'dia' => 'required|integer',
            'hora' => 'required|integer',
            'turno' => 'required',
        ]);

        $comprobar_disponibilidad = Horario::where('aula_id',$request->aula)->where('dia_semana',$request->dia)->where('turno',$request->turno)
            ->where('hora',$request->hora)->get();

        if(count($comprobar_disponibilidad)>0){

            return redirect()->back()->with('danger', 'ESte horario ya esta asignado a algun profesor!');

        }

        $horario = Horario::find($id);
        $horario->aula_id = $request->aula;
        $horario->dia_semana = $request->dia;
        $horario->turno = $request->turno;
        $horario->hora = $request->hora;
        $horario->save();

        return redirect('/profesores/'.$horario->profesor_id.'/ver-horario')->with('success', 'Horario editado con exito!');

    }

    public function borrar($id){

        $horario = Horario::find($id);

        $horario->delete();

        return redirect()->back()->with('success', 'Horario eliminado!');

    }

}
