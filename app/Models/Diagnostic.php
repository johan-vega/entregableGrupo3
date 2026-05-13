<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $primaryKey = 'id_diagnostic';

    protected $fillable = [
        'descripcion',
        'fecha',
        'id_pacient',
        'id_medic',
        'gravedad',
        'recomendaciones',
        'tipo_diagnostico'
    ];

    public function pacients()
    {
        return $this->belongsTo(Pacient::class, 'id_pacient', 'id_pacient');
    }

    public function medics()
    {
        return $this->belongsTo(Medic::class, 'id_medic', 'id_medic');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'id_diagnostic', 'id_diagnostic');
    }
}
