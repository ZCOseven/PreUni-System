<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignatura::whereNull('deleted_at')->get();

        return response()->json($asignaturas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id'   => 'required|exists:cursos,id',
            'docente_id' => 'required|exists:docentes,id',
            'grupo'      => 'nullable|string|max:50',
            'periodo'    => 'required|string|max:20',
            'horario'    => 'required|array',
            'horario.dias'        => 'required|array|min:1',
            'horario.hora_inicio' => 'required|string',
            'horario.hora_fin'    => 'required|string',
            'aula'       => 'required|string|max:50',
            'estado'     => 'sometimes|in:activo,inactivo',
        ]);

        // Validar que el curso esté activo
        $curso = Curso::findOrFail($request->curso_id);
        if ($curso->estado !== 'activo') {
            return response()->json(['error' => 'El curso está inactivo'], 400);
        }

        // Validar que el docente esté activo
        $docente = Docente::findOrFail($request->docente_id);
        if ($docente->estado !== 'activo') {
            return response()->json(['error' => 'El docente está inactivo'], 400);
        }

        $asignatura = Asignatura::create($request->all());

        return response()->json($asignatura, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);
        return response()->json($asignatura);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $request->validate([
            'curso_id'   => 'sometimes|exists:cursos,id',
            'docente_id' => 'sometimes|exists:docentes,id',
            'grupo'      => 'nullable|string|max:50',
            'periodo'    => 'sometimes|string|max:20',
            'horario'    => 'sometimes|array',
            'horario.dias'        => 'sometimes|array|min:1',
            'horario.hora_inicio' => 'sometimes|string',
            'horario.hora_fin'    => 'sometimes|string',
            'aula'       => 'sometimes|string|max:50',
            'estado'     => 'sometimes|in:activo,inactivo',
        ]);

        // Validar curso si viene
        if ($request->curso_id) {
            $curso = Curso::findOrFail($request->curso_id);
            if ($curso->estado !== 'activo') {
                return response()->json(['error' => 'El curso está inactivo'], 400);
            }
        }

        // Validar docente si viene
        if ($request->docente_id) {
            $docente = Docente::findOrFail($request->docente_id);
            if ($docente->estado !== 'activo') {
                return response()->json(['error' => 'El docente está inactivo'], 400);
            }
        }

        $asignatura->update($request->all());

        return response()->json($asignatura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();

        return response()->json(['message' => 'Asignatura eliminada']);
    }
}
