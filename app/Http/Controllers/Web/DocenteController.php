<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    // Mostrar la lista de docentes (activos e inactivos, sin eliminados)
    public function index()
    {
        $docentes = Docente::whereNull('deleted_at')->get();
        return view('modules.docentes.index', compact('docentes'));
    }

    // Guardar o actualizar docente
    public function save(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required|unique:docentes,dni,' . $request->id,
            'fecha_nacimiento' => 'required|date',
            'especialidad' => 'required|string|max:255',
        ]);

        if ($request->id) {
            // Actualizar
            $docente = Docente::findOrFail($request->id);
            $docente->update([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero ?? $docente->genero,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'especialidad' => $request->especialidad,
                'estado' => $request->estado ?? $docente->estado,
            ]);
            $message = 'Docente actualizado correctamente.';
        } else {
            // Crear
            Docente::create([
                'codigo' => 'DOC' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero ?? 'masculino',
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'especialidad' => $request->especialidad,
                'estado' => $request->estado ?? 'activo',
            ]);
            $message = 'Docente creado correctamente.';
        }

        return redirect()->route('docentes.index')->with('success', $message);
    }

    // Eliminar docente (soft delete)
    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }

    // Obtener datos de un docente para el modal de edición (AJAX)
    public function getDocente($id)
    {
        $docente = Docente::findOrFail($id);
        return response()->json($docente);
    }

    // Cargar formularios
    public function loadAddForm()
    {
        return view('components.docente.form_add');
    }

    public function loadEditForm($id)
    {
        $docente = Docente::findOrFail($id);
        return view('components.docente.form_edit', compact('docente'));
    }

    public function loadDetails($id)
    {
        $docente = Docente::findOrFail($id);
        return view('components.docente.detalle', compact('docente'));
    }

    /*
    |--------------------------------------------------------------------------
    | Cargar cursos asignados de un docente para modal
    |--------------------------------------------------------------------------
    */
    public function loadCursosAsignados($id)
    {
        $docente = Docente::with(['asignaturas.curso'])->findOrFail($id);
        $asignaturas = $docente->asignaturas; // colección de asignaturas asignadas

        return view('components.docente.cursos_asignados', compact('docente', 'asignaturas'));
    }
}
