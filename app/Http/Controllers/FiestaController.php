<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Fiesta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

    /**
     * Display the specified resource.
     */
    public function show(Fiesta $fiesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fiesta $fiesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fiesta $fiesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fiesta $fiesta)
    {
        //
    }

    public function getall()
    // Se devuelven todas las fiestas filtradas por el usuario(empresa) sirve para la vista administracion.
    {
        $fiestas =  Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('eliminado', '==', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get();
        // PortalPlaylistElement::with('AirtimePlaylists.AirtimePlaylistContents')->get();
        // foreach ($fiestas as $f){
        //     $f->empresa;
        //     $f->musica;
        //     $f->tematica;
        // }
        $fiestasfiltradas  = [];
        foreach ($fiestas as $f){
            if($f->empresa->id_usuario == Auth::id()){
                // if ($f->entrada->eliminado === 0){
                    array_push($fiestasfiltradas,$f);
                // }
            }
        }
        return $fiestasfiltradas;
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
        $nombrefoto = $request->input('id_empresa') . '--'.str(now()->tz('Europe/Madrid')->format("Y-m-d-H-i-s")) . '--' . $request->file('foto')->getClientOriginalName();
        if($fiesta->foto){
            $ruta = storage_path('/fiestas/'.$fiesta->foto);
            if (file_exists($ruta)){
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
