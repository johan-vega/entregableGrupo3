<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $primaryKey = 'id_pacient';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'direccion',
        'tipo_sangre'
    ];

    public function cites()
    {
        return $this->hasMany(Cite::class, 'id_pacient', 'id_pacient');
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class, 'id_pacient', 'id_pacient');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
