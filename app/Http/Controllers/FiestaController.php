<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Fiesta;
use App\Models\Empresa;
use App\Models\Reserva;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiestaController extends Controller
{

    /**
     *.Funcion para guardar una entrada
     */
    public function store(Request $request)
    {
        $fechahora = substr($request->input('fecha'), 0, 10) . ' 23:00:00';
        $fiesta = new Fiesta;
        $fiesta->fecha = $fechahora;
        // dd($request->input('id_musica'));
        $fiesta->id_tematica = $request->input('id_tematica');
        $fiesta->id_musica = $request->input('id_musica');
        $fiesta->id_empresa = $request->input('id_empresa');
        $fiesta->eliminado = 0;
        $fiesta->foto = $request->input('id_empresa') . '--' . str(now()->tz('Europe/Madrid')->format("Y-m-d-H-i-s")) . '--' . $request->file('foto')->getClientOriginalName();
        $fiesta->save();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            Storage::build(storage_path("/fiestas"))->put($fiesta->foto, file_get_contents($foto));

            return 'Guardado';
        }
        return response()->json(['error' => 'No se encontró la foto'], 400);
    }


    public function getall()
    // Se devuelven todas las fiestas .
    {
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
        return $fiestas;
    }


    public function getforadministracion()
    // Se devuelven todas las fiestas filtradas por el usuario(empresa) sirve para la vista administracion.
    {
        $usuario = Auth::id();
        $empresas = Empresa::where('id_usuario', '=', $usuario)->get('id');
        $ids_empresas = [];
        foreach ($empresas as $empresa) {
            array_push($ids_empresas, $empresa->id);
        }
        $fiestas =  Fiesta::whereIn('id_empresa', $ids_empresas)->where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
        return $fiestas;
    }

    public function entradasadministracion()
    // Se devuelven todas las entradas filtradas por el usuario(empresa) sirve para la vista administracion.
    {
        $usuario = Auth::id();
        $empresas = Empresa::where('id_usuario', '=', $usuario)->get('id');
        $ids_empresas = [];
        foreach ($empresas as $empresa) {
            array_push($ids_empresas, $empresa->id);
        }
        $fiestas =  Fiesta::whereIn('id_empresa', $ids_empresas)->where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada', 'Adentrada'])->get();
        $entradasfiltradas = [];

        foreach ($fiestas as $fiesta) {
            foreach ($fiesta->adentrada as $entrada)
                if ($entrada->eliminado == 0) {
                    $entrada->setAttribute('fecha', $fiesta->fecha);
                    $entrada->setAttribute('empresa', $fiesta->empresa->nombre);
                    array_push($entradasfiltradas, $entrada);
                }
        }
        return $entradasfiltradas;
    }




    public function reservasUsuario()
    // Se devuelven todas las entradas filtradas por las reservas que ha realizado el usuario.
    {
        $id = Auth::id();
        $reservas = Reserva::where('id_cliente', $id)->get();
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entradareserva'])->get();
        $entradasFiltradas = [];


        foreach ($fiestas as $fiesta) {
            foreach ($fiesta->entradareserva as $entrada) {
                foreach ($reservas as $reserva) {
                    if ($entrada->id == $reserva->id_entrada) {
                        $entrada->setAttribute('nombreempresa', $fiesta->empresa->nombre);
                        $entrada->setAttribute('idreserva', $reserva->id);
                        $entrada->setAttribute('fecha', $fiesta->fecha);
                        $entrada->setAttribute('foto', $fiesta->foto);
                        $entrada->setAttribute('musica', $fiesta->musica->nombre);
                        $entrada->setAttribute('tematica', $fiesta->tematica->nombre);
                        array_push($entradasFiltradas, $entrada);
                    }
                }
            }
        }
        return $entradasFiltradas;
    }

    public static function pdfreserva($id_reserva)
    // Se devuelven el contenido de la reserva lal cual queremos imprimir en pdf.
    {
        $reserva = Reserva::find($id_reserva);
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entradareserva'])->get();


        foreach ($fiestas as $fiesta) {
            foreach ($fiesta->entradareserva as $entrada) {
                if ($entrada->id == $reserva->id_entrada) {

                    $entrada->setAttribute('nombreempresa', $fiesta->empresa->nombre);
                    $entrada->setAttribute('fecha', $fiesta->fecha);
                    $entrada->setAttribute('musica', $fiesta->musica->nombre);
                    $entrada->setAttribute('tematica', $fiesta->tematica->nombre);
                    $entrada->setAttribute('id_cliente', $reserva->id_cliente);
                    return $entrada;
                }
            }
        }
    }

    /**
     *.Funcion para eliminar una fiesta
     */
    public function eliminar(Request $request)
    {
        $id = $request->input('id_fiesta');
        $fiesta = Fiesta::find($id);
        $fiesta->eliminado = 1;
        $fiesta->save();
    }


    /**
     *.Funcion para actualizar una fiesta 
     */
    public function actualizar(Request $request)
    {

        $id = $request->input('fiesta_elegida');
        $fiesta = Fiesta::find($id);
        $fiesta->id_tematica = $request->input('id_tematica');
        $fiesta->id_musica = $request->input('id_musica');
        $nombrefoto = $request->input('id_empresa') . '--' . str(now()->tz('Europe/Madrid')->format("Y-m-d-H-i-s")) . '--' . $request->file('foto')->getClientOriginalName();
        if ($fiesta->foto) {
            $ruta = storage_path('/fiestas/' . $fiesta->foto);
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }
        $fiesta->foto = $nombrefoto;
        $fiesta->save();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            Storage::build(storage_path("/fiestas/"))->put($fiesta->foto, file_get_contents($foto));

            return 'Guardado';
        }
    }
}
