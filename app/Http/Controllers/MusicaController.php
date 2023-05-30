<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicaController extends Controller
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
     * Funcino para guardar musica.
     */
    public function store(Request $request)
    {
        $musica = new Musica;
        $musica->nombre = $request->input('nombre');
        $musica->save();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Musica $musica)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musica $musica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Musica $musica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musica $musica)
    {
        //
    }
    /**
     *.Funcion para listar la musica
     */
    public function mostrar()
    {
        $musica = Musica::all();
        foreach($musica as $music){
            $music->setAttribute('filtrado',false);
        }
        return $musica;
    }
}
