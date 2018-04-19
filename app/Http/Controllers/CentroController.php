<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Centro;
use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CentroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('admin/centro/index');

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|string|max:50|min: 3',
            'descripcion' => 'required|string|max: 200|min: 3',
            'email' => 'required|email|max: 30|min :3',
        ]);

        $centro = new Centro;
        $centro->nombre = $request->nombre;
        $centro->descripcion = $request->descripcion;
        $centro->email = $request->email;
        $centro->save();

        return redirect('/personalizar-centro');

    }

    public function subirImagen()
    {

        $this->validate(request(), [
            'img' => 'required|max:15000|image'
        ]);

        $centro = Centro::all()->first();

        $img = request()->file('img')->store('public');

        //Si hay ya una imagen la elimina e introduce la nueva
        if($centro->imagen != null){

            $imgPath = str_replace('storage', 'public', $centro->imagen);
            Storage::delete($imgPath);

        }

        $centro->imagen = Storage::url($img);
        $centro->save();

    }

    public function anadirColor(Request $request, $id)
    {

        $this->validate($request, [
            'color' => 'required|string',
        ]);

        $centro = Centro::find($id);
        $centro->color = $request->color;
        $centro->save();

        return redirect('/importar-datos');

    }

    public function recargarImagen()
    {

        $centro = Centro::all()->first();

        return response()->json($centro);

    }

    public function editar()
    {

        return view('admin/centro/editarCentro');

    }
}
