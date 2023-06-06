<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Entrada;
use App\Models\Fiesta;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
     * Funcion para guardar reservas.
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
    /**
     *.Se devuelven las reservas de un usuario
     */
    public function mostrar()
    {
        return Reserva::where('id_cliente', '=', Auth::id())->get();
    }


    // Devuelve las reservas de la fiesta que esta seleccionada en administracion->mostrar reservas
    public function listarad($id_f){
        $totalReservas = [];
        $fiesta =  Fiesta::with(['Empresa', 'Musica', 'Tematica', 'Adentrada'])->find($id_f);
         foreach ($fiesta->adentrada as $entrada){
            $reservas = Reserva::where('id_entrada',$entrada->id)->get();

            foreach($reservas as $reserva){
                $usuario = User::find($reserva->id_cliente);
                $reserva->setAttribute('nombre',$usuario->nombre);
                $reserva->setAttribute('dni',$usuario->dni);
                $reserva->setAttribute('apellidos',$usuario->apellidos);
                $reserva->setAttribute('email',$usuario->email);
                $reserva->setAttribute('telefono',$usuario->telefono);    
                $reserva->setAttribute('tipo_entrada',$entrada->tipo);    
                array_push($totalReservas,$reserva);

            }
        }

        return Inertia::render('listadoreservas', [

            'reservas'=> $totalReservas,
            'id_seguridad' =>$fiesta->empresa->id_usuario,
            'nombre_empresa' => $fiesta->empresa->nombre,
            'musica' =>$fiesta->musica->nombre,
            'tematica' =>$fiesta->tematica->nombre,
            'fecha_fiesta' =>$fiesta->fecha            

        ]);
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $id_entrada = $request->input('id_entrada');
        Reserva::where('id', $id)->delete();
        $entrada = Entrada::find($id_entrada);
        $entrada->aforo = ($entrada->aforo + 1);
        $entrada->save();
    }

    // Devuelven las ids de las entradas a las cuales pertenecen las reservas para comprobar si puede realizar las reservas en Entradas y en Perfil.
    public function idsreservas(){
        // $id = Auth::id();
        $reservas = Reserva::where('id_cliente', Auth::id())->get();

        $id_entradas = []; 
        foreach ($reservas as $reserva){
            array_push($id_entradas,$reserva->id_entrada);
        }
        return $id_entradas;
    }
}
