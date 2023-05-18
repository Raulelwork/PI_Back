<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Entrada;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
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
        $id_cliente = Auth::id();
        $reservaExistente = Reserva::where('id_cliente', $id_cliente)
            ->where('id_entrada', $request->input('id_entrada'))
            ->exists();

        if (!$reservaExistente) {
            $id_entrada = $request->input('id_entrada');
            $reserva = new Reserva;
            $reserva->fecha_reserva =  Carbon::now()->format('Y-m-d H:i:s');
            $reserva->id_entrada = $id_entrada;
            $reserva->id_cliente = $id_cliente;
            $reserva->save();
            $entrada = Entrada::find($id_entrada);
            $entrada->aforo = ($entrada->aforo - 1);
            $entrada->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function mostrar()
    {
        return Reserva::where('id_cliente', '=', Auth::id())->get();
    }

    public function eliminar(Request $request)
    {
        $id_usuario = Auth::id();
        $id_entrada = $request->input('id_entrada');
        Reserva::where('id_cliente', $id_usuario)
            ->where('id_entrada', $id_entrada)
            ->delete();
        $entrada = Entrada::find($id_entrada);
        $entrada->aforo = ($entrada->aforo + 1);
        $entrada->save();
    }
}
