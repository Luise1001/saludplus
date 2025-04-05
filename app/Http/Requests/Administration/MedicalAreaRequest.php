<?php

namespace App\Http\Requests\Administration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalAreaRequest extends FormRequest
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
                Rule::unique('medical_areas', 'name')->ignore($this->id),
            ],
            'description' => 'required|string|max:500',
            'active' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del área de atención es obligatorio.',
            'name.string' => 'El nombre del área de atención debe ser una cadena de texto.',
            'name.max' => 'El nombre del área de atención no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre del área de atención ya está en uso.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 500 caracteres.',
            'active.boolean' => 'El estado activo debe ser verdadero o falso.',
        ];
    }
}
