<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Listado de matrículas
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $matriculas = Matricula::whereNull('deleted_at')
            ->with(['alumno', 'asignaturas'])
            ->get();

        return view('modules.matriculas.index', compact('matriculas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Crear o actualizar matrícula
    |--------------------------------------------------------------------------
    */
    public function save(Request $request)
    {
        $request->validate([
            'alumno_id'       => 'required|exists:alumnos,id',
            'periodo'         => 'required|string|max:20',
            'estado'          => 'sometimes|in:activo,inactivo',
            'fecha_matricula' => 'required|date',
            'asignaturas'     => 'required|array|min:1',
            'asignaturas.*'   => 'exists:asignaturas,id',
            'observaciones'   => 'nullable|string|max:500',
        ]);

        $matriculaId = $request->input('id');

        if (!empty($matriculaId)) {
            // EDITAR
            $matricula = Matricula::findOrFail($matriculaId);
            $matricula->update($request->only(['alumno_id', 'periodo', 'estado', 'fecha_matricula', 'observaciones']));
            $matricula->asignaturas()->sync($request->asignaturas);

            $message = 'Matrícula actualizada correctamente.';
        } else {
            // CREAR
            $matricula = Matricula::create($request->only(['alumno_id', 'periodo', 'estado', 'fecha_matricula', 'observaciones']));
            $matricula->asignaturas()->attach($request->asignaturas);

            $message = 'Matrícula creada correctamente.';
        }

        return redirect()->route('matriculas.index')->with('success', $message);
    }

    /*
    |--------------------------------------------------------------------------
    | Eliminar matrícula (soft delete)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula eliminada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | Obtener matrícula para edición o visualización AJAX
    |--------------------------------------------------------------------------
    */
    public function getMatricula($id)
    {
        $matricula = Matricula::with(['alumno', 'asignaturas'])->findOrFail($id);
        return response()->json($matricula);
    }

    /*
    |--------------------------------------------------------------------------
    | Cargar formulario para agregar matrícula
    |--------------------------------------------------------------------------
    */
    public function loadAddForm()
    {
        $alumnos = Alumno::where('estado', 'activo')->whereNull('deleted_at')->get();
        $asignaturas = Asignatura::where('estado', 'activo')->whereNull('deleted_at')->get();
        $periodos = ['2025-I', '2025-II', '2026-I', '2026-II'];

        return view('components.matricula.form_add', compact('alumnos', 'asignaturas', 'periodos'));
    }

    /*
|-------------------------------------------------------------------------- 
| Cargar formulario para editar matrícula
|-------------------------------------------------------------------------- 
*/
    public function loadEditForm($id)
    {
        $matricula = Matricula::with('asignaturas')->findOrFail($id);
        $alumnos = Alumno::where('estado', 'activo')->whereNull('deleted_at')->get();
        $asignaturas = Asignatura::where('estado', 'activo')->whereNull('deleted_at')->get();
        $periodos = ['2025-I', '2025-II', '2026-I', '2026-II'];

        // Array de IDs de asignaturas asociadas a esta matrícula
        $asignaturas_ids = $matricula->asignaturas->pluck('id')->toArray();

        return view('components.matricula.form_edit', compact(
            'matricula',
            'alumnos',
            'asignaturas',
            'periodos',
            'asignaturas_ids'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Cargar detalles de la matrícula
    |--------------------------------------------------------------------------
    */
    public function loadDetails($id)
    {
        $matricula = Matricula::with(['alumno', 'asignaturas'])->findOrFail($id);
        return view('components.matricula.detalle', compact('matricula'));
    }
}
