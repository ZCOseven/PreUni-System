<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
     // Mostrar lista de cursos (activos e inactivos, sin eliminados)
    public function index()
    {
        $cursos = Curso::whereNull('deleted_at')->get();
        return view('modules.cursos.index', compact('cursos'));
    }

    // Guardar o actualizar curso
    public function save(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',

        ]);

        if ($request->id) {
            // Actualizar
            $curso = Curso::findOrFail($request->id);
            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado ?? $curso->estado,
            ]);
            $message = 'Curso actualizado correctamente.';
        } else {
            // Crear
            Curso::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado ?? 'activo',
            ]);
            $message = 'Curso creado correctamente.';
        }

        return redirect()->route('cursos.index')->with('success', $message);
    }

    // Eliminar curso (soft delete)
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso eliminado correctamente.');
    }

    // Formularios para modales (AJAX)
    public function loadAddForm()
    {
        return view('components.curso.form_add');
    }

    public function loadEditForm($id)
    {
        $curso = Curso::findOrFail($id);
        return view('components.curso.form_edit', compact('curso'));
    }

    // Opcional: dejar detalles para el futuro
    public function loadDetails($id)
    {
        $curso = Curso::findOrFail($id);
        return view('components.curso.detalle', compact('curso'));
    }
}
