<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('aviso');
});

Route::get('/buscar', [MainController::class, 'buscar'])->name('buscar');
Route::get('/resultados', [MainController::class, 'busqueda'])->name('resultados');
