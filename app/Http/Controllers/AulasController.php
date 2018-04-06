<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Edificio;
use App\Planta;
use Illuminate\Http\Request;

class AulasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar(){

        $aulas = Aula::all();

        return view('admin.aulas.listar')->with('aulas', $aulas);

    }

    public function crear()
    {

        $edificios = Edificio::all();
        $tipos = Aula::select('tipo')->distinct()->get();

        return view('admin.aulas.crear')->with('edificios', $edificios)->with('tipos', $tipos);

    }

    public function sacarPisos(Request $request)
    {

        $plantas = Planta::where('edificio_id','=',$request->edificio_id)->get();

        return response()->json($plantas);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'edificio' => 'required',
            'planta' => 'required',
            'nombre' => 'required|string|max: 20',
            'tipo' => 'required',
            'aforo' => 'required|integer',
        ]);

        $aula = new Aula;
        $aula->edificio_id = $request->edificio[0];
        $aula->planta_id = $request->planta[0];
        $aula->nombre = $request->nombre;
        $aula->tipo = $request->tipo[0];
        $aula->aforo = $request->aforo;
        $aula->save();

        return redirect('/aulas/listar')->with('success', 'Aula creada con exito!');

    }

    public function editar($id)
    {

        $aula = Aula::find($id);
        $edificios = Edificio::all();
        $tipos = Aula::select('tipo')->distinct()->get();

        return view('admin.aulas.editar')->with('edificios', $edificios)->with('aula', $aula)->with('tipos', $tipos);

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'edificio' => 'required',
            'planta' => 'required',
            'nombre' => 'required|string|max: 20',
            'tipo' => 'required',
            'aforo' => 'required|integer',
        ]);

        $aula = Aula::find($id);
        $aula->edificio_id = $request->edificio[0];
        $aula->planta_id = $request->planta[0];
        $aula->nombre = $request->nombre;
        $aula->tipo = $request->tipo[0];
        $aula->aforo = $request->aforo;
        $aula->save();

        return redirect('/aulas/listar')->with('success', 'Aula editada con exito!');

    }

    public function ver($id){

        $aula = Aula::find($id);

        return view('admin.aulas.ver')->with('aula', $aula);

    }

    public function borrar($id){

        $aula = Aula::find($id);

        $aula->delete();

        return redirect('/aulas/listar')->with('success', 'Aula eliminada!');

    }

}
