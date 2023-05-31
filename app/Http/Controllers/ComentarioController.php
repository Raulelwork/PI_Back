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
     * Funcion para guardar comentarios.
     */
    public function store(Request $request)
    {


        $validacion = $request->validate([
            'contenido' => ['required', 'regex:/^[A-Za-z0-9.,!\s]+$/'],

        ]);
        // Guarda el comentario
        $comentario = new Comentario();

        $comentario->contenido = $request->input('contenido');
        $comentario->id_empresa = $request->input('id_empresa');
        $comentario->id_usuario = Auth::id();
        $comentario->fecha =  Carbon::now()->format('Y-m-d H:i:s');
        $comentario->save();
        // Añadimos el nombre del usuario y devuelvo el comentario para añadirlo a los comentarios
        $comentario->setAttribute('nombreusuario', '');
        $userName = User::where('id', $comentario->id_usuario)->get('nombre');
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
     *.
     */
    public function destroy(Comentario $comentario)
    {
        //
    }
    /**
     * Funcion para listar los comentarios
     */
    public function listar()
    {
        $comentarios = Comentario::all();

        foreach ($comentarios as $comentario) {
            $usuario = User::find($comentario->id_usuario);
            $comentario->setAttribute('nombre', $usuario->nombre);
        }
        return $comentarios;
    }
    /**
     *.Funcion para eliminar comentarios
     */
    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $comentario = Comentario::find($id);
        $comentario->delete();
    }
}
