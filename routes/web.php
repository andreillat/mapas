<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuntoGpsController;

Route::get('/puntos-gps', [PuntoGpsController::class, 'index'])->name('puntos_gps.index');
Route::get('/procesar-puntos', [PuntoGpsController::class, 'procesarTrama'])->name('puntos_gps.procesar');