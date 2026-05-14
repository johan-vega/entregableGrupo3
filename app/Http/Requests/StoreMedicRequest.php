<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMedicRequest extends FormRequest
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
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:medics,email'],
            'licencia' => ['required', 'string', 'max:255'],
            'anios_experiencia' => ['required', 'integer', 'min:0', 'max:80'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'apellido' => 'apellido',
            'especialidad' => 'especialidad',
            'telefono' => 'telefono',
            'email' => 'email',
            'licencia' => 'licencia',
            'anios_experiencia' => 'anios de experiencia',
        ];
    }
}
