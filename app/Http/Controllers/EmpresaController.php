<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Empresa;
use App\Models\Comentario;
use App\Models\Fiesta;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmpresaController extends Controller
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

        $userid = Auth::id();
        $empresa = new Empresa;
        $empresa->id_usuario = $userid;
        $empresa->nombre = $request->input('nombre');
        $empresa->cif = $request->input('cif');
        $empresa->ubicacion = $request->input('ubicacion');
        $empresa->lugar = $request->input('lugar');
        $empresa->foto = $empresa->nombre . '--' . str(now()->tz('Europe/Madrid')->format("Y-m-d-H-i-s")) . '--' . $request->file('foto')->getClientOriginalName();
        $empresa->save();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            Storage::build(storage_path("/empresas"))->put($empresa->foto, file_get_contents($foto));

            return 'Guardado';
        }
        return response()->json(['error' => 'No se encontró la foto'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }

    public function getallid()
    {
        return Empresa::where('id_usuario', Auth::id())->get();
    }
    
    public function getall()
    {
        return Empresa::all();
    }
    public function getrandom()
    {
        return Empresa::inRandomOrder()->take(5)->get();
    }
    public function cargaperfil($id){
        $empresa = Empresa::where('id',$id)->first();
        $comentarios = Comentario::where('id_empresa',$id)->get();
        // $comentarios->setAttribute('nombre_usuario','');
        foreach($comentarios as $comentario){
            $userName = User::where('id',$comentario->id_usuario)->get('nombre');
            $comentario->setAttribute('nombreusuario','');
            $comentario->nombreusuario = $userName[0]->nombre;
        }
        // dd($comentarios[0]->contenido);
        $empresa->setAttribute('comentarios',$comentarios);

        return Inertia::render('perfil', [
            'empresa' => $empresa,
            'fiestas'=> Fiesta::where('fecha', '>', now()->format('Y-m-d'))->where('id_empresa','=',$id)->where('eliminado', '=', 0)->with(['Empresa', 'Musica', 'Tematica', 'Entrada'])->get()

        ]);
    }

}
