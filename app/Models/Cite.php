<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'fecha',
        'motivo',
        'id_pacient',
        'id_medic',
        'estado',
        'observaciones',
        'sala'
    ];

    public function pacients()
    {
        return $this->belongsTo(Pacient::class, 'id_pacient', 'id_pacient');
    }

    public function medics()
    {
        return $this->belongsTo(Medic::class, 'id_medic', 'id_medic');
    }
}
