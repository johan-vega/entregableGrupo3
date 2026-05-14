<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

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

    protected static function booted(): void
    {
        static::saving(function (self $medic) {
            if ($medic->anios_experiencia === null) {
                return;
            }

            foreach (['años_experiencia', 'aÃ±os_experiencia'] as $legacyColumn) {
                if (Schema::hasColumn($medic->getTable(), $legacyColumn)) {
                    $medic->setAttribute($legacyColumn, $medic->anios_experiencia);
                }
            }
        });
    }

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
