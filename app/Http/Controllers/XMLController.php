<?php

namespace App\Http\Controllers;


use App\Aula;
use App\Edificio;
use App\Equipamiento;
use App\Planta;
use App\Profesor;
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

    public function index()
    {

        return view('admin/importar/xml');

    }

    public function subirArchivo(Request $request)
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

    public function importar(Request $request)
    {

        $this->validate(request(), [
            'tipoFichero' => 'required'
        ]);

        if($request->tipoFichero === 'aulas'){

            return $this->importarAulas($request->confirmar);

        }elseif($request->tipoFichero === 'usuarios'){

            return $this->importarUsuarios($request->confirmar);

        }elseif($request->tipoFichero === 'reservas'){

            return $this->importarReservas($request->confirmar);

        }

    }

    public function importarAulas($delete)
    {
        //Si marcas eliminar datos actuales borra el contenido de las tablas antes de insertar
        if($delete) {

            Edificio::all()->each->delete();

        }

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
                    $aula->tipo = $aulaXML[@tipo];
                    $aula->aforo = $aulaXML->aforo;
                    $aula->save();

                    if (is_array($aulaXML->equipamientos->equipamiento) || is_object($aulaXML->equipamientos->equipamiento)) {
                        foreach ($aulaXML->equipamientos->equipamiento as $equipamientoXML) {

                            $equipamiento = new Equipamiento;
                            $equipamiento->aula_id = $aula->id;
                            $equipamiento->nombre = $equipamientoXML;
                            $equipamiento->cantidad = $equipamientoXML[@cantidad];
                            $equipamiento->save();

                        }
                    }

                }

            }

        }

        return redirect('/importar-xml')->with('success',  'El fichero de aulas ha sido importado correctamente!');

    }

    public function importarUsuarios($delete)
    {

        //Si marcas eliminar datos actuales borra el contenido de las tablas antes de insertar
        if($delete) {

            Profesor::all()->each->delete();

        }

        $xmlPath = str_replace('storage', 'public', auth()->user()->xml);
        //Lectura fichero XML del servidor
        $contents = File::get(public_path().'/../storage/app'.$xmlPath);
        //Conversion a array
        $xml = simplexml_load_string($contents);
        //Algoritmo de almacenamiento en BD
        foreach ($xml->usuario as $usuarioXML) {

            $profesor = new Profesor;
            $profesor->name = $usuarioXML->nombre;
            $profesor->email = $usuarioXML->email;
            $profesor->password = bcrypt('123456');
            $profesor->remember_token = ' ';
            $profesor->save();

        }

        return redirect('/importar-xml')->with('success',  'El fichero de usuarios ha sido importado correctamente!');

    }

    public function importarReservas($delete)
    {

        return 'en proceso';

    }

}
