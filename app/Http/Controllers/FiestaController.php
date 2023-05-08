<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Fiesta;
use App\Models\Empresa;
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
        $fiesta = new Fiesta;
        $fiesta->fecha = $request->input('fecha');
        $fiesta->id_tematica = 2;
        $fiesta->id_musica = 2;
        $fiesta->id_empresa = $request->input('id_empresa');
        $fiesta->foto = '--' . str(now()->tz('Europe/Madrid')->format("Y-m-d-H-i-s")) . '--' . $request->file('foto')->getClientOriginalName();
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
    {
        // $empresas = new Empresa;
        // $empresas =  Empresa::where('id_usuario', Auth::id())->get();
        // $fiestas = [];
        // foreach($empresas as $e){
        //     array_push($fiestas,Fiesta::where('id_empresa',$e->id)->get());
        // }
        return Fiesta::all();
    }
}