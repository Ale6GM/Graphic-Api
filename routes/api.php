<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\CrimenController;
use App\Http\Controllers\Api\DelincuenteController;
use App\Http\Controllers\Api\VictimaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ventas', [ClienteController::class, 'getData'])->name('ventas');

Route::get('clientes', [ClienteController::class, 'getClientes'])->name('clientes');

// Rutas para recoger los datos de las tablas individuales
Route::get('years', [CrimenController::class, 'getCrimenesPorAno'])->name('years');
Route::get('crimenes', [CrimenController::class, 'getCrimenes'])->name('crimenes');
Route::get('modus', [CrimenController::class, 'getCrimenesPorModus'])->name('modus');

Route::get('victimas', [VictimaController::class, 'getVictimas'])->name('victimas');
Route::get('delincuentes', [DelincuenteController::class, 'getDelincuentes'])->name('delincuentes');
Route::get('crimendelin', [CrimenController::class, 'getCrimenesDelincuentes'])->name('crimendelin');



