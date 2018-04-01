<?php

namespace App\Http\Controllers;


use App\Aula;
use App\Edificio;
use App\Planta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class XMLController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function aulas()
    {

        return view('admin/aulas/xml');

    }

    public function subirAulas(Request $request)
    {

        $this->validate(request(), [
            'xml' => 'required|max:50|mimes:xml'
        ]);

        $xml = request()->file('xml')->store('public');
        $user= User::find(auth()->user()->id);

        //Si hay ya un archivo XML lo elimina e introduce el nuevo
        if($user->xml != null){

            $xmlPath = str_replace('storage', 'public', $user->xml);
            Storage::delete($xmlPath);

        }

        $user->xml = Storage::url($xml);
        $user->save();

    }

    public function importarAulas()
    {

        $xmlPath = str_replace('storage', 'public', auth()->user()->xml);
        //Lectura fichero XML del servidor
        $contents = File::get(public_path().'/../storage/app'.$xmlPath);
        //Conversion a array
        $xml = simplexml_load_string($contents);
        //Algoritmo de almacenamiento en BD
        foreach ($xml->edificio as $edificioXML) {

            $edificio = new Edificio;
            $edificio->nombre = $edificioXML->nombre;
            $edificio->save();

            foreach ($edificioXML->plantas->planta as $plantaXML) {

                $planta = new Planta;
                $planta->edificio_id = $edificio->id;
                $planta->piso = $plantaXML->piso;
                $planta->save();

                foreach ($plantaXML->aulas->aula as $aulaXML) {

                    $aula = new Aula;
                    $aula->edificio_id = $edificio->id;
                    $aula->planta_id = $planta->id;
                    $aula->nombre = $aulaXML->nombre;
                    $aula->tipo = $aulaXML->tipo;
                    $aula->aforo = $aulaXML->aforo;
                    $aula->save();

                }

            }

        }

        return redirect()->back()->with('success',  'El fichero ha sido importado correctamente!');

    }

}
