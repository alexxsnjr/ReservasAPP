<?php

namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar(){

        $profesores = Profesor::all();

        return view('admin.profesores.listar')->with('profesores', $profesores);

    }

    public function crear()
    {

        return view('admin.profesores.crear');

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:profesors',
            'nombre' => 'required|string|max: 20',
        ]);

        $profesor = new Profesor;
        $profesor->name = $request->nombre;
        $profesor->email = $request->email;
        $profesor->password = bcrypt('123456');
        $profesor->save();

        return redirect('/profesores/listar')->with('success', 'Profesor creado con exito!');

    }

    public function editar($id)
    {

        $profesor = Profesor::find($id);

        return view('admin.profesores.editar')->with('profesor', $profesor);

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:profesors,email,'.$id,
            'nombre' => 'required|string|max: 20',
        ]);

        $profesor = Profesor::find($id);
        $profesor->name = $request->nombre;
        $profesor->email = $request->email;
        $profesor->save();

        return redirect('/profesores/listar')->with('success', 'Profesor editado con exito!');

    }

    public function borrar($id){

        $profesor = Profesor::find($id);

        $profesor->delete();

        return redirect('/profesores/listar')->with('success', 'Profesor eliminado!');

    }

    public function ver($id){

        $profesor = Profesor::find($id);

        return view('admin.profesores.ver')->with('profesor', $profesor);

    }

    public function restaurarClave($id){

        $profesor = Profesor::find($id);
        $profesor->password = bcrypt('123456');
        $profesor->save();

        return redirect()->back()->with('success', 'Clave restaurada con exito!');

    }

}
