<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matriculas = Matricula::with(['alumno', 'asignaturas'])->whereNull('deleted_at')->get();
        return response()->json($matriculas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        // Validar que el alumno esté activo
        $alumno = Alumno::findOrFail($request->alumno_id);
        if ($alumno->estado !== 'activo') {
            return response()->json(['error' => 'El alumno está inactivo'], 400);
        }

        // Crear matrícula
        $matricula = Matricula::create($request->only(['alumno_id', 'periodo', 'estado', 'fecha_matricula', 'observaciones']));

        // Asociar asignaturas en la tabla pivot
        $matricula->asignaturas()->attach($request->asignaturas);

        // Cargar relaciones
        $matricula->load(['alumno', 'asignaturas']);

        return response()->json($matricula, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matricula = Matricula::with(['alumno', 'asignaturas'])->findOrFail($id);
        return response()->json($matricula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $matricula = Matricula::findOrFail($id);

        $request->validate([
            'alumno_id'       => 'sometimes|exists:alumnos,id',
            'periodo'         => 'sometimes|string|max:20',
            'estado'          => 'sometimes|in:activo,inactivo',
            'fecha_matricula' => 'sometimes|date',
            'asignaturas'     => 'sometimes|array|min:1',
            'asignaturas.*'   => 'exists:asignaturas,id',
            'observaciones'   => 'nullable|string|max:500',
        ]);

        // Validar alumno si viene
        if ($request->alumno_id) {
            $alumno = Alumno::findOrFail($request->alumno_id);
            if ($alumno->estado !== 'activo') {
                return response()->json(['error' => 'El alumno está inactivo'], 400);
            }
        }

        // Actualizar matrícula
        $matricula->update($request->only(['alumno_id', 'periodo', 'estado', 'fecha_matricula', 'observaciones']));

        // Actualizar asignaturas si vienen
        if ($request->has('asignaturas')) {
            $matricula->asignaturas()->sync($request->asignaturas);
        }

        $matricula->load(['alumno', 'asignaturas']);

        return response()->json($matricula);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();

        return response()->json(['message' => 'Matrícula eliminada']);
    }
}
