<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Mostrar la lista de alumnos (activos e inactivos, sin eliminados)
    public function index()
    {
        $alumnos = Alumno::whereNull('deleted_at')->get();
        return view('modules.alumnos.index', compact('alumnos'));
    }

    // Guardar o actualizar alumno (si llega id, actualiza; si no, crea)
    public function save(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required|unique:alumnos,dni,' . $request->id,
            'fecha_nacimiento' => 'required|date',
        ]);

        if ($request->id) {
            // Actualizar
            $alumno = Alumno::findOrFail($request->id);
            $alumno->update([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero ?? $alumno->genero,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'estado' => $request->estado ?? $alumno->estado,
            ]);
            $message = 'Alumno actualizado correctamente.';
        } else {
            // Crear
            Alumno::create([
                'codigo' => 'ALU' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero ?? 'masculino',
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'estado' => $request->estado ?? 'activo',
            ]);
            $message = 'Alumno creado correctamente.';
        }

        return redirect()->route('alumnos.index')->with('success', $message);
    }

    // Eliminar alumno (soft delete)
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }

    // Obtener datos de un alumno para el modal de edición (AJAX)
    public function getAlumno($id)
    {
        $alumno = Alumno::findOrFail($id);
        return response()->json($alumno);
    }

    // Cargar formularios
    public function loadAddForm()
    {
        return view('components.alumno.form_add');
    }

    public function loadEditForm($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('components.alumno.form_edit', compact('alumno'));
    }

    public function loadDetails($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('components.alumno.detalle', compact('alumno'));
    }
}
