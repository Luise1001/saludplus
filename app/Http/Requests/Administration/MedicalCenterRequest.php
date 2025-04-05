<?php

namespace App\Http\Requests\Administration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalCenterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medical_centers', 'name')->ignore($this->id)
            ],
            'short_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medical_centers', 'short_name')->ignore($this->id)
            ],
            'document' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medical_centers', 'document')->ignore($this->id)
            ],
            'active' => 'nullable|boolean',
            'state_id' => [
                'required',
                'integer',
                Rule::exists('states', 'id')
            ],
            'municipality_id' => [
                'required',
                'integer',
                Rule::exists('municipalities', 'id')
            ],
            'parish_id' => [
                'required',
                'integer',
                Rule::exists('parishes', 'id')
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del centro médico es obligatorio.',
            'name.string' => 'El nombre del centro médico debe ser una cadena de texto.',
            'name.max' => 'El nombre del centro médico no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre del centro médico ya está en uso.',
            'short_name.required' => 'El nombre corto del centro médico es obligatorio.',
            'short_name.string' => 'El nombre corto del centro médico debe ser una cadena de texto.',
            'short_name.max' => 'El nombre corto del centro médico no puede tener más de 255 caracteres.',
            'short_name.unique' => 'El nombre corto del centro médico ya está en uso.',
            'document.required' => 'El documento del centro médico es obligatorio.',
            'document.string' => 'El documento del centro médico debe ser una cadena de texto.',
            'document.max' => 'El documento del centro médico no puede tener más de 255 caracteres.',
            'document.unique' => 'El documento del centro médico ya está en uso.',
            'active.boolean' => 'El estado activo debe ser verdadero o falso.',
            'state_id.required' => 'El estado es obligatorio.',
            'state_id.integer' => 'El estado debe ser un número entero.',
            'state_id.exists' => 'El estado seleccionado no es válido.',
            'municipality_id.required' => 'El municipio es obligatorio.',
            'municipality_id.integer' => 'El municipio debe ser un número entero.',
            'municipality_id.exists' => 'El municipio seleccionado no es válido.',
            'parish_id.required' => 'La parroquia es obligatoria.',
            'parish_id.integer' => 'La parroquia debe ser un número entero.',
            'parish_id.exists' => 'La parroquia seleccionada no es válida.'
        ];
    }
}
