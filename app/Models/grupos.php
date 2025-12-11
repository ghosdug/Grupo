<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;

    // Especificar la clave primaria si no es 'id'
    protected $primaryKey = 'id'; // O la columna que uses como clave primaria
    
    // Si la clave primaria no es auto-incremental
    // public $incrementing = false;
    
    // Si la clave primaria no es un entero
    // protected $keyType = 'string';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'periodo',
        'materia',
        'rfc',
        'alumno_escritos',
        'grupo',
        'estatus_grupo',
        'capacidad_grupo',
        'tipo_personal',
        'folio_acta',
        'paralelo_de',
        'exclusivo_carrera',
        'exclusivo_reticula',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array
     */
    protected $casts = [
        'alumno_escritos' => 'integer',
        'capacidad_grupo' => 'integer',
    ];
}
