<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FiestaController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/fiestas', function () {
    return Inertia::render('entradas');
});

Route::get('/reservas', function () {
    return Inertia::render('reservas');
});


Route::get('/perfil', function () {
    return Inertia::render('perfil');
});

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

Route::post('/crearempresa',[EmpresaController::class,'store']);

Route::get('/listarempresas',[EmpresaController::class,'getall']);

Route::get('/listarfiestas',[FiestaController::class,'getall']);

Route::post('/crearfiestas',[FiestaController::class,'store']);

Route::get('/listarmusica',[MusicaController::class,'mostrar']);


require __DIR__.'/auth.php';
