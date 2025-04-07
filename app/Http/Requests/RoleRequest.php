<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $active = $this->active ? 1 : 0;
        $this->merge(['active' => $active]);
        
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->id),
            ],
            'display_name' => 'required|string|max:255',
            'color' => 'nullable|string',
            'level' => 'required|integer',
            'active' => 'nullable|boolean',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'display_name.required' => 'El nombre para mostrar es obligatorio.',
            'display_name.string' => 'El nombre para mostrar debe ser una cadena de texto.',
            'display_name.max' => 'El nombre para mostrar no puede tener más de 255 caracteres.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'level.required' => 'El nivel es obligatorio.',
            'level.integer' => 'El nivel debe ser un número entero.',
            'active.boolean' => 'El estado activo debe ser verdadero o falso.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 255 caracteres.',
        ];
    }
}
