<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('Inicio');

Route::get('/crimen', function() {
    return view('graficas.crimen');
})->name('Crimen');

Route::get('victima', function() {
    return view('graficas.victima');
})->name('Victima');

Route::get('delincuente', function() {
    return view('graficas.delincuente');
})-> name('Delincuente');

Route::get('combinadas', function() {
    return view('graficas.combinadas');
})->name('Combinadas');