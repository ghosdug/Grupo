<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupos;
use App\Http\Resources\grupoResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupos::orderBy('periodo')->get();
        return grupoResource::collection($grupos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'periodo' => 'required|string|max:5',
            'materia' => 'nullable|string|max:255',
            'rfc' => 'required|string|max:13',
            'alumno_escritos' => 'required|integer|min:0',
            'grupo' => 'required|string|max:255',
            'estatus_grupo' => 'required|string|max:50',
            'capacidad_grupo' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $grupo = Grupos::create($request->all());
        return new grupoResource($grupo);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grupo = Grupos::findOrFail($id);
        return new grupoResource($grupo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'periodo' => 'required|string|max:5',
            'materia' => 'nullable|string|max:255',
            'rfc' => 'required|string|max:13',
            'alumno_escritos' => 'required|integer|min:0',
            'grupo' => 'required|string|max:255',
            'estatus_grupo' => 'required|string|max:50',
            'capacidad_grupo' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $grupo = Grupos::findOrFail($id);
        $grupo->update($request->all());
        return new grupoResource($grupo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grupo = Grupos::findOrFail($id);
        try {
            $grupo->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Grupo eliminado correctamente'], 200);
    }
}
