<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlumnoController;

// Rutas para alumnos (API RESTful)

Route::prefix('alumnos')->group(function () {
    Route::get('/', [AlumnoController::class, 'index']);     
    Route::post('/', [AlumnoController::class, 'store']);    
    Route::get('/{id}', [AlumnoController::class, 'show']);  
    Route::put('/{id}', [AlumnoController::class, 'update']);
    Route::delete('/{id}', [AlumnoController::class, 'destroy']);
});