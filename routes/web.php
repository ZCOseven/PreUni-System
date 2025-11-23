<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AlumnoController;
use App\Http\Controllers\Web\AsignaturaController;
use App\Http\Controllers\Web\CursoController;
use App\Http\Controllers\Web\DocenteController;
use App\Http\Controllers\Web\MatriculaController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboards por rol
|--------------------------------------------------------------------------
*/

// Dashboard para administradores
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', RoleMiddleware::class . ':admin'])->name('admin.dashboard');

// Dashboard para docentes (solo prueba)
Route::get('/docente/dashboard', function () {
    return view('docente.dashboard');
})->middleware(['auth', RoleMiddleware::class . ':docente'])->name('docente.dashboard');

// Dashboard futuro para alumnos
Route::get('/alumno/dashboard', function () {
    return "Dashboard Alumno (no implementado)";
})->middleware(['auth', RoleMiddleware::class . ':alumno'])->name('alumno.dashboard');


/*
|--------------------------------------------------------------------------
| Módulo de Alumnos (solo administradores)
|--------------------------------------------------------------------------
|
| Todas las rutas del CRUD web se gestionan desde alumnos/index mediante 
| AJAX y un modal. No hay vistas por separado.
|
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('alumnos')
    ->name('alumnos.')
    ->group(function () {

        // Vista principal con la tabla y el modal
        Route::get('/', [AlumnoController::class, 'index'])->name('index');

        // Crear o actualizar alumno
        Route::post('/save', [AlumnoController::class, 'save'])->name('save');

        // Obtener datos de un alumno para edición vía AJAX
        Route::get('/{id}/data', [AlumnoController::class, 'getAlumno'])->name('data');

        // Eliminar alumno (soft delete)
        Route::delete('/{id}', [AlumnoController::class, 'destroy'])->name('destroy');

        /*
        |--------------------------------------------------------------------------
        | Nuevas rutas para cargar componentes del modal
        |--------------------------------------------------------------------------
        */
        Route::get('/modal/add', [AlumnoController::class, 'loadAddForm'])->name('modal.add');
        Route::get('/modal/{id}/edit', [AlumnoController::class, 'loadEditForm'])->name('modal.edit');
        Route::get('/modal/{id}/details', [AlumnoController::class, 'loadDetails'])->name('modal.details');
    });


/*
|-------------------------------------------------------------------------- 
| Módulo de Docentes (solo administradores)
|-------------------------------------------------------------------------- 
|
| Todas las rutas del CRUD web se gestionan desde docentes/index mediante 
| AJAX y un modal. No hay vistas por separado.
|
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('docentes')
    ->name('docentes.')
    ->group(function () {

        // Vista principal con la tabla y el modal
        Route::get('/', [DocenteController::class, 'index'])->name('index');

        // Crear o actualizar docente
        Route::post('/save', [DocenteController::class, 'save'])->name('save');

        // Obtener datos de un docente para edición vía AJAX
        Route::get('/{id}/data', [DocenteController::class, 'getDocente'])->name('data');

        // Eliminar docente (soft delete)
        Route::delete('/{id}', [DocenteController::class, 'destroy'])->name('destroy');

        /*
        |----------------------------------------------------------------------
        | Nuevas rutas para cargar componentes del modal
        |----------------------------------------------------------------------
        */
        Route::get('/modal/add', [DocenteController::class, 'loadAddForm'])->name('modal.add');
        Route::get('/modal/{id}/edit', [DocenteController::class, 'loadEditForm'])->name('modal.edit');
        Route::get('/modal/{id}/details', [DocenteController::class, 'loadDetails'])->name('modal.details');

        /*
        |----------------------------------------------------------------------
        | NUEVO: Cursos asignados del docente modal
        |----------------------------------------------------------------------
        */
        Route::get('/{id}/cursos-asignados', [DocenteController::class, 'loadCursosAsignados'])
            ->name('cursos_asignados');
    });



/*
|--------------------------------------------------------------------------
| Módulo de Cursos (solo administradores)
|--------------------------------------------------------------------------
|
| Todas las rutas del CRUD web se gestionan desde cursos/index mediante 
| AJAX y un modal. No hay vistas por separado.
|
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('cursos')
    ->name('cursos.')
    ->group(function () {

        // Vista principal con la tabla y el modal
        Route::get('/', [CursoController::class, 'index'])->name('index');

        // Crear o actualizar curso
        Route::post('/save', [CursoController::class, 'save'])->name('save');

        // Obtener datos de un curso para edición vía AJAX
        Route::get('/{id}/data', [CursoController::class, 'getCurso'])->name('data');

        // Eliminar curso (soft delete)
        Route::delete('/{id}', [CursoController::class, 'destroy'])->name('destroy');

        /*
        |--------------------------------------------------------------------------
        | Nuevas rutas para cargar componentes del modal
        |--------------------------------------------------------------------------
        */
        Route::get('/modal/add', [CursoController::class, 'loadAddForm'])->name('modal.add');
        Route::get('/modal/{id}/edit', [CursoController::class, 'loadEditForm'])->name('modal.edit');
        Route::get('/modal/{id}/details', [CursoController::class, 'loadDetails'])->name('modal.details'); // Opcional
    });

/*
|--------------------------------------------------------------------------
| Módulo de Asignaturas (solo administradores)
|--------------------------------------------------------------------------
|
| Todas las rutas del CRUD web se gestionan desde asignaturas/index mediante
| AJAX y un modal. No hay vistas por separado.
|
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('asignaturas')
    ->name('asignaturas.')
    ->group(function () {

        // Vista principal con la tabla y el modal
        Route::get('/', [AsignaturaController::class, 'index'])->name('index');

        // Crear o actualizar asignatura
        Route::post('/save', [AsignaturaController::class, 'save'])->name('save');

        // Obtener datos de una asignatura para edición vía AJAX
        Route::get('/{id}/data', [AsignaturaController::class, 'getAsignatura'])->name('data');

        // Eliminar asignatura (soft delete)
        Route::delete('/{id}', [AsignaturaController::class, 'destroy'])->name('destroy');

        /*
        |--------------------------------------------------------------------------
        | Nuevas rutas para cargar componentes del modal
        |--------------------------------------------------------------------------
        */
        Route::get('/modal/add', [AsignaturaController::class, 'loadAddForm'])->name('modal.add');
        Route::get('/modal/{id}/edit', [AsignaturaController::class, 'loadEditForm'])->name('modal.edit');
        Route::get('/modal/{id}/details', [AsignaturaController::class, 'loadDetails'])->name('modal.details');
    });


/*
|--------------------------------------------------------------------------
| Módulo de Matrículas (solo administradores)
|--------------------------------------------------------------------------
|
| Todas las rutas del CRUD web se gestionan desde matriculas/index mediante
| AJAX y un modal. No hay vistas por separado.
|
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('matriculas')
    ->name('matriculas.')
    ->group(function () {

        // Vista principal con la tabla y el modal
        Route::get('/', [MatriculaController::class, 'index'])->name('index');

        // Crear o actualizar matrícula
        Route::post('/save', [MatriculaController::class, 'save'])->name('save');

        // Obtener datos de una matrícula para edición vía AJAX
        Route::get('/{id}/data', [MatriculaController::class, 'getMatricula'])->name('data');

        // Eliminar matrícula (soft delete)
        Route::delete('/{id}', [MatriculaController::class, 'destroy'])->name('destroy');

        /*
        |--------------------------------------------------------------------------
        | Nuevas rutas para cargar componentes del modal
        |--------------------------------------------------------------------------
        */
        Route::get('/modal/add', [MatriculaController::class, 'loadAddForm'])->name('modal.add');
        Route::get('/modal/{id}/edit', [MatriculaController::class, 'loadEditForm'])->name('modal.edit');
        Route::get('/modal/{id}/details', [MatriculaController::class, 'loadDetails'])->name('modal.details');
    });
