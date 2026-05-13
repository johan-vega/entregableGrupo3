<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    protected $primaryKey = 'id_medic';

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'telefono',
        'email',
        'licencia',
        'anios_experiencia'
    ];

    public function cites()
    {
        return $this->hasMany(Cite::class, 'id_medic', 'id_medic');
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class, 'id_medic', 'id_medic');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'id_medic', 'id_medic');
    }
}
