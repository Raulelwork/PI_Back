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
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '==', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
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
        $fiestas =  Fiesta::whereIn('id_empresa', $ids_empresas)->where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '==', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
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
        $fiestas =  Fiesta::whereIn('id_empresa', $ids_empresas)->where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '==', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
        $entradasfiltradas = [];

        foreach ($fiestas as $fiesta) {
            foreach ($fiesta->entrada as $entrada)
                if ($entrada->eliminado == 0) {
                    $entrada->setAttribute('fecha',$fiesta->fecha);
                    $entrada->setAttribute('empresa',$fiesta->empresa->nombre);
                    array_push($entradasfiltradas, $entrada);
                }}
        return $entradasfiltradas;
    }




    public function reservasUsuario()
    // Se devuelven todas las fiestas filtradas por las reservas que ha realizado el usuario.
    {
        $id = Auth::id();
        $reservas = Reserva::where('id_cliente', $id)->get();
        $ids_reservas = [];
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '==', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
        $fiestasFiltradas = [];
        foreach ($reservas as $reserva) {
            array_push($ids_reservas, $reserva->id_entrada);
        }

        foreach ($fiestas as $fiesta){
            foreach($fiesta->entrada as $entrada){
                if(in_array($entrada->id,$ids_reservas)){
                    $fiesta->setAttribute('entradaactual',$entrada);
                    array_push($fiestasFiltradas,$fiesta);
                }
            }
        }
        return $fiestasFiltradas;
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id_fiesta');
        $fiesta = Fiesta::find($id);
        $fiesta->eliminado = 1;
        $fiesta->save();
    }


    
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
