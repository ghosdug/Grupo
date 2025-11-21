<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    /**
     * Mostrar todos los grupos.
     */
    public function index()
    {
        $grupos = Grupos::orderBy('periodo')->get();

        return view('grupos.index', compact('grupos'));
    }

    /**
     * Mostrar formulario para crear un nuevo grupo.
     */
    public function create()
    {
        return view('grupos.create');
    }

    /**
     * Guardar un nuevo grupo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periodo' => 'required|string|max:5',
            'materia' => 'nullable|string|max:255',
            'rfc' => 'required|string|max:13',
            'alumno_escritos' => 'required|integer|min:0',
            'grupo' => 'required|string|max:255',
            'estatus_grupo' => 'required|string|max:50',
            'capacidad_grupo' => 'required|integer|min:1',
            'tipo_personal' => 'nullable|string|max:100',
            'folio_acta' => 'nullable|string|max:100',
            'paralelo_de' => 'nullable|string|max:100',
            'exclusivo_carrera' => 'nullable|string|max:100',
            'exclusivo_reticula' => 'nullable|string|max:100',
        ], [
            'alumno_escritos.min' => 'El número de alumnos inscritos no puede ser negativo.',
            'alumno_escritos.required' => 'El número de alumnos inscritos es obligatorio.',
            'capacidad_grupo.min' => 'La capacidad del grupo debe ser al menos 1.',
            'capacidad_grupo.required' => 'La capacidad del grupo es obligatoria.',
            'periodo.required' => 'El período es obligatorio.',
            'periodo.max' => 'El período no puede tener más de 5 caracteres.',
            'grupo.required' => 'El nombre del grupo es obligatorio.',
            'estatus_grupo.required' => 'El estatus del grupo es obligatorio.',
            'rfc.required' => 'El RFC del profesor es obligatorio.',
            'rfc.max' => 'El RFC no puede tener más de 13 caracteres.',
        ]);

        // Validación adicional: alumnos inscritos no pueden exceder la capacidad
        if ($request->alumno_escritos > $request->capacidad_grupo) {
            return back()->withErrors([
                'alumno_escritos' => 'El número de alumnos inscritos no puede exceder la capacidad del grupo.'
            ])->withInput();
        }

        Grupos::create([
            'periodo' => $request->periodo,
            'materia' => $request->materia,
            'rfc' => strtoupper($request->rfc), // Convertir RFC a mayúsculas
            'alumno_escritos' => $request->alumno_escritos,
            'grupo' => $request->grupo,
            'estatus_grupo' => $request->estatus_grupo,
            'capacidad_grupo' => $request->capacidad_grupo,
            'tipo_personal' => $request->tipo_personal,
            'folio_acta' => $request->folio_acta,
            'paralelo_de' => $request->paralelo_de,
            'exclusivo_carrera' => $request->exclusivo_carrera,
            'exclusivo_reticula' => $request->exclusivo_reticula,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Mostrar los detalles de un grupo específico.
     */
    public function show($id)
    {
        $grupo = Grupos::findOrFail($id);
        return view('grupos.show', compact('grupo'));
    }

    /**
     * Mostrar formulario para editar un grupo existente.
     */
    public function edit($id)
    {
        $grupo = Grupos::findOrFail($id);
        return view('grupos.edit', compact('grupo'));
    }

    /**
     * Actualizar la información de un grupo.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'periodo' => 'required|string|max:5',
            'materia' => 'nullable|string|max:255',
            'rfc' => 'required|string|max:13',
            'alumno_escritos' => 'required|integer|min:0',
            'grupo' => 'required|string|max:255',
            'estatus_grupo' => 'required|string|max:50',
            'capacidad_grupo' => 'required|integer|min:1',
            'tipo_personal' => 'nullable|string|max:100',
            'folio_acta' => 'nullable|string|max:100',
            'paralelo_de' => 'nullable|string|max:100',
            'exclusivo_carrera' => 'nullable|string|max:100',
            'exclusivo_reticula' => 'nullable|string|max:100',
        ], [
            'alumno_escritos.min' => 'El número de alumnos inscritos no puede ser negativo.',
            'alumno_escritos.required' => 'El número de alumnos inscritos es obligatorio.',
            'capacidad_grupo.min' => 'La capacidad del grupo debe ser al menos 1.',
            'capacidad_grupo.required' => 'La capacidad del grupo es obligatoria.',
            'periodo.required' => 'El período es obligatorio.',
            'periodo.max' => 'El período no puede tener más de 5 caracteres.',
            'grupo.required' => 'El nombre del grupo es obligatorio.',
            'estatus_grupo.required' => 'El estatus del grupo es obligatorio.',
            'rfc.required' => 'El RFC del profesor es obligatorio.',
            'rfc.max' => 'El RFC no puede tener más de 13 caracteres.',
        ]);

        // Validación adicional: alumnos inscritos no pueden exceder la capacidad
        if ($request->alumno_escritos > $request->capacidad_grupo) {
            return back()->withErrors([
                'alumno_escritos' => 'El número de alumnos inscritos no puede exceder la capacidad del grupo.'
            ])->withInput();
        }

        $grupo = Grupos::findOrFail($id);

        $grupo->update([
            'periodo' => $request->periodo,
            'materia' => $request->materia,
            'rfc' => strtoupper($request->rfc), // Convertir RFC a mayúsculas
            'alumno_escritos' => $request->alumno_escritos,
            'grupo' => $request->grupo,
            'estatus_grupo' => $request->estatus_grupo,
            'capacidad_grupo' => $request->capacidad_grupo,
            'tipo_personal' => $request->tipo_personal,
            'folio_acta' => $request->folio_acta,
            'paralelo_de' => $request->paralelo_de,
            'exclusivo_carrera' => $request->exclusivo_carrera,
            'exclusivo_reticula' => $request->exclusivo_reticula,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Eliminar un grupo.
     */
    public function destroy($id)
    {
        try {
            $grupo = Grupos::findOrFail($id);
            $nombreGrupo = $grupo->grupo;
            $periodo = $grupo->periodo;
            
            $grupo->delete();

            return redirect()->route('grupos.index')
                ->with('success', "Grupo {$nombreGrupo} del período {$periodo} eliminado correctamente.");
        } catch (\Exception $e) {
            return redirect()->route('grupos.index')
                ->with('error', 'Error al eliminar el grupo: ' . $e->getMessage());
        }
    }
}