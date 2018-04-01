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

        return view('admin.aulas.crear')->with('edificios', $edificios);

    }

    public function sacarPisos($edidicio_id)
    {

        $plantas = Planta::where('edificio_id',$edidicio_id);

        dd($plantas);

    }

    public function store(Request $request)
    {

            $this->validate($request, [
                'titulo' => 'required|string|min: 3',
                'extracto' => 'required|min: 5|max: 120',
                'contenido' => 'required|min: 10|max: 1000',
            ]);

            $posts = new Post;
            $posts->titulo = $request->titulo;
            $posts->slug = str_slug($request->titulo);
            $posts->extracto = $request->extracto;
            $posts->contenido = $request->contenido;
            $posts->user_id = auth()->user()->id;
            $posts->save();

            $categorias = collect($request->categoria)->map(function ($categoria){
                return Categoria::find($categoria) ? $categoria : Categoria::create(['name' => $categoria])->id;
            });

            $posts->categoria()->sync($categorias);

            return redirect('/post/listar')->with('success', 'Post creado con exito!');

    }

    public function editar($id)
    {

            $post = Post::where('slug', $slug)->firstOrFail();

            $categorias = Categoria::all();

            return view('admin.post.edit')->with('post', $post)->with('categorias', $categorias);

    }

    public function update(Request $request, $id)
    {

            $this->validate($request, [
                'titulo' => 'required|string|min: 3|unique:posts,slug,'.$slug,
                'extracto' => 'required|min: 5|max: 120',
                'contenido' => 'required|min: 10|max: 1000',
            ]);

            $posts = Post::where('slug', $slug)->firstOrFail();
            $posts->titulo = $request->titulo;
            $posts->slug = str_slug($request->titulo);
            $posts->extracto = $request->extracto;
            $posts->contenido = $request->contenido;
            $posts->save();

        $categorias = collect($request->categoria)->map(function ($categoria){
           return Categoria::find($categoria) ? $categoria : Categoria::create(['name' => $categoria])->id;
        });

        $posts->categoria()->sync($categorias);

        return redirect('/post/listar')->with('success', 'Post editado con exito!');


    }

    public function borrar($id){

        $aula = Aula::find($id);

        $aula->delete();

        return redirect()->back()->with('success', 'Aula eliminada');

    }

}
