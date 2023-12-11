<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;
use App\Http\Controllers\InteraccionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'perro'], function () {
    Route::post('/registrarPerro', [PerroController::class, 'registrarPerro']);
    Route::post('/actualizarPerro', [PerroController::class, 'actualizarPerro']);
    Route::get('/listarPerro/{id}', [PerroController::class, 'listarPerro']);
    Route::get('/listarPerros', [PerroController::class, 'listarPerros']);
    Route::get('/eliminarPerro/{id}', [PerroController::class, 'eliminarPerro']);
    Route::get('/perroRandom/{id}', [PerroController::class, 'perroRandom']);
});

Route::group(['prefix' => 'interaccion'], function () {
    Route::post('/registrarInteraccion', [InteraccionController::class, 'registrarInteraccion']);
    Route::get('/candidato', [InteraccionController::class, 'perroCandidato']);
    Route::get('/verAceptados', [InteraccionController::class, 'verAceptados']);
    Route::get('/verRechazados', [InteraccionController::class, 'verRechazados']);
});


