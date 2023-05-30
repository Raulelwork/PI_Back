<?php

namespace App\Http\Controllers;

use App\Models\Tematica;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TematicaController extends Controller
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
     * Funcion para guardar tematicas
     */
    public function store(Request $request)
    {
        $tematica = new Tematica;
        $tematica->nombre = $request->input('nombre');
        $tematica->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tematica $tematica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tematica $tematica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tematica $tematica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tematica $tematica)
    {
        //
    }
    /**
     *.Funcion para mostrar las tematicas
     */
    public function mostrar()
    {
        $tematica = Tematica::all();
        foreach ($tematica as $tem) {
            $tem->setAttribute('filtrado', false);
        }
        return $tematica;
    }
}
