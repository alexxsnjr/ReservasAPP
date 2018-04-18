<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Ies;
use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('asistente')->except('terminar','personalizar','subirImagen','recargarImagen','anadirColor','importarDatos','consultarDatos');

    }

    public function index()
    {

        return view('admin/asistente/index');

    }

    public function datos()
    {

        return view('admin/asistente/datos');

    }

    public function personalizar()
    {

        $centro = Ies::all();
        return view('admin/asistente/personalizar')->with('centro',$centro);

    }

    public function subirImagen()
    {

        $this->validate(request(), [
            'img' => 'required|max:15000|image'
        ]);

        $centro = Ies::all();

        $img = request()->file('img')->store('public');

        //Si hay ya una imagen la elimina e introduce la nueva
        if($centro[0]->imagen != null){

            $imgPath = str_replace('storage', 'public', $centro[0]->imagen);
            Storage::delete($imgPath);

        }

        $centro[0]->imagen = Storage::url($img);
        $centro[0]->save();

    }

    public function recargarImagen(Request $request)
    {

        $centro = Ies::where('nombre','=',$request->centro)->get();

        return response()->json($centro);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|string|max:50|min: 3',
            'descripcion' => 'required|string|max: 200|min: 3',
            'email' => 'required|email|max: 30|min :3',
        ]);

        $centro = new Ies;
        $centro->nombre = $request->nombre;
        $centro->descripcion = $request->descripcion;
        $centro->email = $request->email;
        $centro->save();

        return redirect('/personalizar-centro');

    }

    public function anadirColor(Request $request, $id)
    {

        $this->validate($request, [
            'color' => 'required|string',
        ]);

        $centro = Ies::find($id);
        $centro->color = $request->color;
        $centro->save();

        return redirect('/importar-datos');

    }

    public function importarDatos()
    {

        $centro = Ies::all();
        return view('admin/asistente/insertarDatos')->with('centro',$centro);

    }

    public function consultarDatos()
    {

        $aulas = Aula::all();
        $usuarios = Profesor::all();

        $respuesta=[];

        if(count($aulas)>0){

            $respuesta["aulas"]='1';

        }
        if(count($usuarios)>0){

            $respuesta["usuarios"]='1';

        }

        return response()->json($respuesta);

    }

    public function terminar()
    {

        return view('admin/asistente/final');

    }
}
