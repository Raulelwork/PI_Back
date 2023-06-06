<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\FiestaController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TematicaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PDFController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Inicio', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Inicio');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Cargar vistas

Route::get('/fiestas', function () {
    return Inertia::render('entradas');
});

Route::get('/reservas', function () {
    return Inertia::render('reservas');
});


Route::get('/perfil/{id}',[EmpresaController::class,'cargaperfil']);

Route::get('/listadoreserva/{id_fiesta}',[ReservaController::class,'listarad']);

Route::get('/administracion', function () {
    return Inertia::render('administracion');
});

Route::get('/crearent', function () {
    return Inertia::render('crearentrada');
});

Route::get('/crearfiesta', function () {
    return Inertia::render('crearfiesta');
});

Route::get('/crearempresa', function () {
    return Inertia::render('crearempresa');
});

Route::get('/editafiesta', function () {
    return Inertia::render('editarfiesta');
});

Route::get('/control', function () {
    return Inertia::render('addcontent');
});

Route::get('/locales', function () {
    return Inertia::render('locales');
});



// Crear/insertar datos

Route::post('/crearempresa',[EmpresaController::class,'store']);

Route::post('/crearfiestas',[FiestaController::class,'store']);

Route::post('/crearentradas',[EntradaController::class,'store']);

Route::post('/hacerreserva',[ReservaController::class,'store']);

Route::post('/insertacomentario',[ComentarioController::class,'store']);

Route::post('/actualizafiesta',[FiestaController::class,'actualizar']);

Route::post('/crearmusica',[MusicaController::class,'store']);

Route::post('/creartematica',[TematicaController::class,'store']);

// Listar datos

Route::get('/listarempresas',[EmpresaController::class,'getallid']);

Route::get('/listarallempresas',[EmpresaController::class,'getall']);

Route::get('/listarrandomempresas',[EmpresaController::class,'getrandom']);

Route::get('/listarfiestas',[FiestaController::class,'getall']);

Route::get('/listarfiestasad',[FiestaController::class,'getforadministracion']);

Route::get('/listarentradasad',[FiestaController::class,'entradasadministracion']);

Route::get('/listarentradas',[EntradaController::class,'mostrar']);

Route::get('/listarmusica',[MusicaController::class,'mostrar']);

Route::get('/listartematica',[TematicaController::class,'mostrar']);

Route::get('/listarreservas',[ReservaController::class,'mostrar']);

Route::get('/reservasdeusuario',[FiestaController::class,'reservasUsuario']);

Route::get('/listarcomentarios',[ComentarioController::class,'listar']);

Route::get('/reservasusuario',[ReservaController::class,'idsreservas']);



// Eliminar Datos

Route::post('/eliminarentrada',[EntradaController::class,'eliminar']);

Route::post('/eliminarfiesta',[FiestaController::class,'eliminar']);

Route::post('/eliminarreserva',[ReservaController::class,'eliminar']);

Route::post('/eliminarcomentario',[ComentarioController::class,'eliminar']);

Route::post('/eliminarempresa',[EmpresaController::class,'eliminar']);


// pdf

Route::get('/pdfreserva/{id_reserva}', [PDFController::class,'pdfreserva']);



require __DIR__.'/auth.php';
