<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntradaController extends Controller
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
     * Funcion para guardar una entrada.
     */
    public function store(Request $request)
    {

        $Entrada = new Entrada;
        $Entrada->id_fiesta = $request->input('fiesta_elegida');
        $Entrada->precio = $request->input('precio');
        $Entrada->aforo = $request->input('aforo');
        $Entrada->aforoinicial = $request->input('aforo');
        $Entrada->consumiciones = $request->input('consumiciones');
        $Entrada->tipo = $request->input('tipo');
        $Entrada->eliminado = false;

        $Entrada->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
    /**
     *.Funcion para mostrar las entradas
     */
    public function mostrar()
    {
        return Entrada::where('aforo', '>', 0)->get();
    }
    /**
     *.Funcion para eliminar una entrada
     */
    public function eliminar(Request $request)
    {
        $id = $request->input('id_entrada');
        $entrada = Entrada::find($id);
        $entrada->eliminado = 1;
        $entrada->save();
    }
}
