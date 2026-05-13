<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $primaryKey = 'id_medication';

    protected $fillable = [
        'nombre',
        'dosis',
        'frecuencia',
        'duracion',
        'id_treatment',
        'proveedor',
        'efectos_secundarios'
    ];

    public function treatments()
    {
        return $this->belongsTo(Treatment::class, 'id_treatment', 'id_treatment');
    }
    /** @use HasFactory<\Database\Factories\MedicationFactory> */
    use HasFactory;
}
