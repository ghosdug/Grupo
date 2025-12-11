<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class grupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'periodo' => $this->periodo,
            'materia' => $this->materia,
            'rfc' => $this->rfc,
            'alumno_escritos' => $this->alumno_escritos,
            'grupo' => $this->grupo,
            'estatus_grupo' => $this->estatus_grupo,
        'capacidad_grupo' => $this->capacidad_grupo,
        'tipo_personal' => $this->tipo_personal,
        'folio_acta' => $this->folio_acta,
        'paralelo_de' => $this->paralelo_de,
        'exclusivo_carrera' => $this->exclusivo_carrera,
        'exclusivo_reticula' => $this->exclusivo_reticula,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at, 
        ];
    }
}
