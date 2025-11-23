<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::whereNull('deleted_at')->get();
        return response()->json($cursos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cursos,nombre',
            'descripcion' => 'nullable|string',
            'estado' => 'sometimes|in:activo,inactivo',
        ]);

        $curso = Curso::create($request->all());
        return response()->json($curso, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::findOrFail($id);
        return response()->json($curso);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $curso = Curso::findOrFail($id);

        $request->validate([
            'nombre' => "sometimes|string|max:255|unique:cursos,nombre,$id",
            'descripcion' => 'nullable|string',
            'estado' => 'sometimes|in:activo,inactivo',
        ]);

        $curso->update($request->all());
        return response()->json($curso);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete(); // solo marca deleted_at
        return response()->json(['message' => 'Curso eliminado']);
    }
}
