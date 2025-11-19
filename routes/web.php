<?php


use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard para administradores
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', RoleMiddleware::class . ':admin'])->name('admin.dashboard');

// FUTURO — Dashboard para docentes
Route::get('/docente/dashboard', function () {
    return view('docente.dashboard');
})->middleware(['auth', RoleMiddleware::class . ':docente'])->name('docente.dashboard');

// FUTURO — Dashboard para alumnos
Route::get('/alumno/dashboard', function () {
    return "Dashboard Alumno (no implementado)";
})->middleware(['auth', RoleMiddleware::class . ':alumno'])->name('alumno.dashboard');

