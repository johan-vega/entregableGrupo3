<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePacientRequest extends FormRequest
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
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:50'],
            'direccion' => ['required', 'string', 'max:255'],
            'tipo_sangre' => ['required', 'string', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'apellido' => 'apellido',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'genero' => 'genero',
            'telefono' => 'telefono',
            'direccion' => 'direccion',
            'tipo_sangre' => 'tipo de sangre',
            'password' => 'contrasena',
        ];
    }
}
