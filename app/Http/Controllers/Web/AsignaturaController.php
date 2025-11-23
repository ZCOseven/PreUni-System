<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Listado de asignaturas
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $asignaturas = Asignatura::whereNull('deleted_at')
            ->with(['curso', 'docente'])
            ->get();

        return view('modules.asignaturas.index', compact('asignaturas'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'curso_id'   => 'required|exists:cursos,id',
            'docente_id' => 'required|exists:docentes,id',
            'periodo'    => 'required|string|max:20',
            'horario.dias' => 'required|array|min:1',
            'aula'       => 'required|string|max:50',
            'estado'     => 'sometimes|in:activo,inactivo',
        ]);

        $diasSeleccionados = $request->input('horario.dias', []);
        $horario = [];

        foreach ($diasSeleccionados as $dia) {
            $inicio = $request->input("horario.hora_inicio_$dia");
            $fin = $request->input("horario.hora_fin_$dia");

            if ($inicio && $fin) {
                $horario[] = [
                    'dia' => ucfirst($dia),
                    'inicio' => $inicio,
                    'fin' => $fin,
                ];
            }
        }

        $asignaturaId = $request->input('id');

        if (!empty($asignaturaId)) {
            // EDITAR
            $asignatura = Asignatura::findOrFail($asignaturaId);
            $asignatura->update([
                'curso_id'   => $request->curso_id,
                'docente_id' => $request->docente_id,
                'periodo'    => $request->periodo,
                'horario'    => $horario,
                'aula'       => $request->aula,
                'estado'     => $request->estado ?? $asignatura->estado,
            ]);

            $message = 'Asignatura actualizada correctamente.';
        } else {
            // CREAR
            Asignatura::create([
                'curso_id'   => $request->curso_id,
                'docente_id' => $request->docente_id,
                'periodo'    => $request->periodo,
                'horario'    => $horario,
                'aula'       => $request->aula,
                'estado'     => $request->estado ?? 'activo',
            ]);

            $message = 'Asignatura creada correctamente.';
        }

        return redirect()->route('asignaturas.index')->with('success', $message);
    }




    /*
    |--------------------------------------------------------------------------
    | Eliminar asignatura (soft delete)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura eliminada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | Obtener asignatura para edición o visualización AJAX
    |--------------------------------------------------------------------------
    */
    public function getAsignatura($id)
    {
        $asignatura = Asignatura::with(['curso', 'docente'])->findOrFail($id);
        return response()->json($asignatura);
    }

    /*
    |--------------------------------------------------------------------------
    | Cargar formulario para agregar asignatura
    |--------------------------------------------------------------------------
    */
    public function loadAddForm()
    {
        $cursos = Curso::where('estado', 'activo')->whereNull('deleted_at')->get();
        $docentes = Docente::where('estado', 'activo')->whereNull('deleted_at')->get();

        $periodos = ['2025-1', '2025-2', '2026-1'];
        $aulas = ['AULA-101', 'AULA-102' , 'AULA-103', 'AULA-201', 'AULA-202', 'LAB-01', 'LAB-02'];

        return view('components.asignatura.form_add', compact('cursos', 'docentes', 'periodos', 'aulas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Cargar formulario para editar asignatura
    |--------------------------------------------------------------------------
    */
    public function loadEditForm($id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $cursos = Curso::where('estado', 'activo')->whereNull('deleted_at')->get();
        $docentes = Docente::where('estado', 'activo')->whereNull('deleted_at')->get();

        $periodos = ['2025-1', '2025-2', '2026-1'];
        $aulas = ['AULA-101', 'AULA-102' , 'AULA-103', 'AULA-201', 'AULA-202', 'LAB-01', 'LAB-02'];

        return view('components.asignatura.form_edit', compact(
            'asignatura',
            'cursos',
            'docentes',
            'periodos',
            'aulas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Cargar detalles de la asignatura
    |--------------------------------------------------------------------------
    */
    public function loadDetails($id)
    {
        $asignatura = Asignatura::with(['curso', 'docente'])->findOrFail($id);
        return view('components.asignatura.detalle', compact('asignatura'));
    }
}
