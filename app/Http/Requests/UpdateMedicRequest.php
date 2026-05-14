<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicRequest extends FormRequest
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
        $medicId = $this->route('medic')?->id_medic ?? $this->route('medic');

        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', Rule::unique('medics', 'email')->ignore($medicId, 'id_medic')],
            'licencia' => ['required', 'string', 'max:255'],
            'anios_experiencia' => ['required', 'integer', 'min:0', 'max:80'],
        ];
    }
}
