<?php

namespace App\Http\Controllers;


use App\Aula;
use App\Edificio;
use App\Equipamiento;
use App\Centro;
use App\Horario;
use App\Planta;
use App\Profesor;
use App\Reserva;
use DOMDocument;
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
            'xml' => 'required'
        ]);

        $xml = request()->file('xml')->store('import');

        $centro= Centro::all()->first();

        //Si hay ya un archivo XML lo elimina e introduce el nuevo
        if($centro->xml != null){

            Storage::delete($centro->xml);

        }

        $centro->xml = $xml;
        $centro->save();

    }

    public function importar(Request $request)
    {

        $this->validate(request(), [
            'tipoFichero' => 'required|in:aulas,usuarios,reservas'
        ]);

        if($request->tipoFichero === 'aulas'){

            if($this->validarXML(public_path('xsdschema/ValidarAulas.xsd'))) {

                return $this->importarAulas($request->confirmar);

            }else {

                return redirect()->back()->with('danger','El fichero XML importado no es valido.');

            }

        }elseif($request->tipoFichero === 'usuarios'){

            if($this->validarXML(public_path('xsdschema/ValidarUsuarios.xsd'))) {

                return $this->importarUsuarios($request->confirmar);

            }else{

                return redirect()->back()->with('danger','El fichero XML importado no es valido.');

            }

        }elseif($request->tipoFichero === 'reservas'){

            if($this->validarXML(public_path('xsdschema/ValidarReservas.xsd'))) {

                return $this->importarReservas($request->confirmar);

            }else{

                return redirect()->back()->with('danger','El fichero XML importado no es valido.');

            }

        }

    }

    public function validarXML($xsd){

        $centro= Centro::all()->first();

        libxml_use_internal_errors(true);

        $xml = new DOMDocument();
        $xml->load(storage_path('app/'.$centro->xml));

        if(!$xml->schemaValidate($xsd)){

            return false;

        }else {

            return true;

        }

    }

    public function importarAulas($delete)
    {
        //Si marcas eliminar datos actuales borra el contenido de las tablas antes de insertar
        //Edificios, Plantas y Aulas
        if($delete) {

            Edificio::all()->each->delete();

        }

        $centro= Centro::all()->first();

        //Lectura fichero XML del servidor
        $contents = File::get(storage_path('app/'.$centro->xml));

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

        return redirect()->back()->with('success',  'El fichero de aulas ha sido importado correctamente!');

    }

    public function importarUsuarios($delete)
    {

        //Si marcas eliminar datos actuales borra el contenido de las tablas antes de insertar
        if($delete) {

            Profesor::all()->each->delete();

        }

        $centro= Centro::all()->first();

        //Lectura fichero XML del servidor
        $contents = File::get(storage_path('app/'.$centro->xml));

        //Conversion a array
        $xml = simplexml_load_string($contents);

        //Algoritmo de almacenamiento en BD
        foreach ($xml->usuario as $usuarioXML) {

            $profesor = new Profesor;
            $profesor->name = $usuarioXML->nombre;
            $profesor->email = $usuarioXML->email;
            $profesor->password = bcrypt('123456');
            $profesor->remember_token = ' ';
            try {
                $profesor->save();
            }
            catch (\Exception $e) {
                return redirect()->back()->with('danger','Ha fallado la importacion del fichero, compruebe que este 
                            bien formateado y cumpla con la integridad de la base de datos.');
            }

            foreach ($usuarioXML->horario as $horarioXML) {

                foreach ($horarioXML->reservas as $reservasXML) {

                    foreach ($reservasXML->reserva as $reservaXML) {

                        $horario = new Horario;
                        $horario->profesor_id = $profesor->id;
                        $horario->aula_id = $reservaXML->aula;
                        $horario->dia_semana = $reservaXML[@dia];
                        $horario->turno = $reservaXML->turno;
                        $horario->hora = $reservaXML->hora;
                        try {
                            $horario->save();
                        }
                        catch (\Exception $e) {
                            return redirect()->back()->with('danger','Ha fallado la importacion del fichero, compruebe que este 
                            bien formateado y cumpla con la integridad de la base de datos.');
                        }

                    }

                }

            }

        }

        return redirect()->back()->with('success',  'El fichero de usuarios ha sido importado correctamente!');

    }

    public function importarReservas($delete)
    {

        //Si marcas eliminar datos actuales borra el contenido de las tablas antes de insertar
        if($delete) {

            Reserva::all()->each->delete();

        }

        $centro= Centro::all()->first();

        //Lectura fichero XML del servidor
        $contents = File::get(storage_path('app/'.$centro->xml));

        //Conversion a array
        $xml = simplexml_load_string($contents);

        //Algoritmo de almacenamiento en BD
        foreach ($xml->reserva as $reservaXML) {

            $reserva = new Reserva;
            $reserva->profesor_id = $reservaXML->profesor_id;
            $reserva->aula_id = $reservaXML->aula_id;
            $reserva->fecha = $reservaXML->fecha;
            $reserva->turno = $reservaXML->turno;
            $reserva->hora = $reservaXML->hora;
            try {
                $reserva->save();
            }
            catch (\Exception $e) {
                //return $e->getMessage();

                return redirect()->back()->with('danger','Ha fallado la importacion del fichero, compruebe que este
                            bien formateado y cumpla con la integridad de la base de datos.');
            }

        }

        return redirect()->back()->with('success',  'El fichero de reservas ha sido importado correctamente!');

    }

}
