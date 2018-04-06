<?php

namespace App\Http\Controllers;

use App\Equipamiento;
use Illuminate\Http\Request;

class EquipamientosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function crear($aula_id)
    {

        $tipos = Equipamiento::select('nombre')->distinct()->get();
        return view('admin.aulas.equipamientos.crear')->with('aula_id', $aula_id)->with('tipos', $tipos);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombres[]' => '',
            'cantidad' => 'required|integer',
        ]);

        $equipamiento = new Equipamiento;
        $equipamiento->aula_id = $request->aula_id;
        $equipamiento->cantidad = $request->cantidad;
        $equipamiento->nombre = $request->nombres[0];

        $equipamiento->save();

        return redirect('/aulas/'.$request->aula_id.'/ver')->with('success', 'Equipamiento añadido con exito!');

    }

    public function editar($id)
    {

        $equipamientos = Equipamiento::find($id);
        $tipos = Equipamiento::select('nombre')->distinct()->get();

        return view('admin.aulas.equipamientos.editar')->with('equipamiento', $equipamientos)->with('tipos', $tipos);

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'nombres[]' => '',
            'cantidad' => 'required|integer',
        ]);

        $equipamiento = Equipamiento::find($id);
        $equipamiento->cantidad = $request->cantidad;
        $equipamiento->nombre = $request->nombres[0];

        $equipamiento->save();

        return redirect('/aulas/'.$equipamiento->aula_id.'/ver')->with('success', 'Equipo editado con exito!');

    }

    public function borrar($id){

        $equipamiento = Equipamiento::find($id);

        $equipamiento->delete();

        return redirect()->back()->with('success', 'Equipamiento eliminado!');

    }

}
