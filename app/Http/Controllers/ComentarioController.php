<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ComentarioController extends Controller
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
        // Guarda el comentario
        $comentario = new Comentario();
        $comentario->contenido = $request->input('contenido');
        $comentario->id_empresa = $request->input('id_empresa');
        $comentario->id_usuario = Auth::id();
        $comentario->eliminado = 0;
        $comentario->fecha =  Carbon::now()->format('Y-m-d H:i:s');
        $comentario->save();
        // Añadimos el nombre del usuario y devuelvo el comentario para añadirlo a los comentarios
        $comentario->setAttribute('nombreusuario','');
        $userName = User::where('id',$comentario->id_usuario)->get('nombre');
        $comentario->nombreusuario = $userName[0]->nombre;
        return $comentario;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        //
    }
}
