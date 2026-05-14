<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $statuses = ['Activo', 'Completado', 'Suspendido'];

        return [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'duracion' => ['required', 'string', 'max:255'],
            'id_diagnostic' => ['required', 'integer', 'exists:diagnostics,id_diagnostic'],
            'id_medic' => ['required', 'integer', 'exists:medics,id_medic'],
            'estado' => ['required', 'string', Rule::in($statuses)],
            'frecuencia_administracion' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'descripcion' => 'descripcion',
            'duracion' => 'duracion',
            'id_diagnostic' => 'diagnostico',
            'id_medic' => 'medico',
            'estado' => 'estado',
            'frecuencia_administracion' => 'frecuencia de administracion',
        ];
    }
}
