<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $primaryKey = 'id_treatment';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'id_diagnostic',
        'id_medic',
        'estado',
        'frecuencia_administracion'
    ];

    public function diagnostics()
    {
        return $this->belongsTo(Diagnostic::class, 'id_diagnostic', 'id_diagnostic');
    }

    public function medics()
    {
        return $this->belongsTo(Medic::class, 'id_medic', 'id_medic');
    }

    public function medications()
    {
        return $this->hasMany(Medications::class, 'id_treatment', 'id_treatment');
    }
}
