<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;

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
    Route::get('/listarPerro', [PerroController::class, 'listarPerro']);
    Route::get('/eliminarPoke/{id}', [PerroController::class, 'eliminarPerro']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
