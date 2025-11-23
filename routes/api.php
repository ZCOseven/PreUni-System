<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\AsignaturaController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\DocenteController;
use App\Http\Controllers\Api\MatriculaController;

Route::prefix('alumnos')->group(function () {
    Route::get('/', [AlumnoController::class, 'index']);     
    Route::post('/', [AlumnoController::class, 'store']);    
    Route::get('/{id}', [AlumnoController::class, 'show']);  
    Route::put('/{id}', [AlumnoController::class, 'update']);
    Route::delete('/{id}', [AlumnoController::class, 'destroy']);
});

Route::prefix('docentes')->group(function () {
    Route::get('/', [DocenteController::class, 'index']);     
    Route::post('/', [DocenteController::class, 'store']);    
    Route::get('/{id}', [DocenteController::class, 'show']);  
    Route::put('/{id}', [DocenteController::class, 'update']);
    Route::delete('/{id}', [DocenteController::class, 'destroy']);
});

Route::prefix('cursos')->group(function () {
    Route::get('/', [CursoController::class, 'index']);     
    Route::post('/', [CursoController::class, 'store']);    
    Route::get('/{id}', [CursoController::class, 'show']);  
    Route::put('/{id}', [CursoController::class, 'update']);
    Route::delete('/{id}', [CursoController::class, 'destroy']);
});

Route::prefix('asignaturas')->group(function () {
    Route::get('/', [AsignaturaController::class, 'index']);    
    Route::post('/', [AsignaturaController::class, 'store']);   
    Route::get('/{id}', [AsignaturaController::class, 'show']); 
    Route::put('/{id}', [AsignaturaController::class, 'update']);
    Route::delete('/{id}', [AsignaturaController::class, 'destroy']);
});

Route::prefix('matriculas')->group(function () {
    Route::get('/', [MatriculaController::class, 'index']);      
    Route::post('/', [MatriculaController::class, 'store']);     
    Route::get('/{id}', [MatriculaController::class, 'show']);   
    Route::put('/{id}', [MatriculaController::class, 'update']); 
    Route::delete('/{id}', [MatriculaController::class, 'destroy']);
});
