<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCiteRequest extends FormRequest
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
        $statuses = ['Pendiente', 'Confirmada', 'Completada', 'Cancelada'];

        return [
            'fecha' => ['required', 'date'],
            'motivo' => ['required', 'string', 'max:255'],
            'id_pacient' => ['required', 'integer', 'exists:pacients,id_pacient'],
            'id_medic' => ['required', 'integer', 'exists:medics,id_medic'],
            'estado' => ['required', 'string', Rule::in($statuses)],
            'observaciones' => ['nullable', 'string'],
            'sala' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fecha' => 'fecha',
            'motivo' => 'motivo',
            'id_pacient' => 'paciente',
            'id_medic' => 'medico',
            'estado' => 'estado',
            'observaciones' => 'observaciones',
            'sala' => 'sala',
        ];
    }
}
