<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'buscar'])->name('buscar');
Route::get('/resultados', [MainController::class, 'busqueda'])->name('resultados');
Route::get('/cni', [MainController::class, 'cni'])->name('cni');