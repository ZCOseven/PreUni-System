<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::whereNull('deleted_at')->get();
        return response()->json($docentes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'dni' => 'required|string|unique:docentes,dni',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:masculino,femenino,otro',
            'email' => 'nullable|email|unique:docentes,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'especialidad' => 'required|string|max:255',
            'estado' => 'sometimes|in:activo,inactivo',
        ]);

        $docente = Docente::create($request->all());
        return response()->json($docente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docente = Docente::findOrFail($id);
        return response()->json($docente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $docente = Docente::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido_paterno' => 'sometimes|string|max:255',
            'apellido_materno' => 'sometimes|string|max:255',
            'dni' => "sometimes|string|unique:docentes,dni,$id",
            'fecha_nacimiento' => 'sometimes|date',
            'genero' => 'sometimes|in:masculino,femenino,otro',
            'email' => "nullable|email|unique:docentes,email,$id",
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'especialidad' => 'sometimes|string|max:255',
            'estado' => 'sometimes|in:activo,inactivo',
        ]);

        $docente->update($request->all());
        return response()->json($docente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete(); // solo cambia deleted_at
        return response()->json(['message' => 'Docente eliminado']);
    }
}
