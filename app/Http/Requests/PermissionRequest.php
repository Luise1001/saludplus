<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
                Rule::unique('permissions', 'name')->ignore($this->id),
            ],
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
            'menu_id' => 'required|integer|exists:menu,id',
            'route' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre ya está en uso.',
            'display_name.required' => 'El nombre para mostrar es obligatorio.',
            'display_name.string' => 'El nombre para mostrar debe ser una cadena de texto.',
            'display_name.max' => 'El nombre para mostrar no puede tener más de 255 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 255 caracteres.',
            'active.boolean' => 'El estado activo debe ser verdadero o falso.',
            'roles.array' => 'Los roles deben ser un arreglo.',
            'roles.*.required' => 'El rol es obligatorio.',
            'roles.*.integer' => 'El rol debe ser un número entero.',
            'roles.*.exists' => 'El rol seleccionado no es válido.',
            'menu_id.required' => 'El menú es obligatorio.',
            'menu_id.integer' => 'El menú debe ser un número entero.',
            'menu_id.exists' => 'El menú seleccionado no es válido.',
            'icon.required' => 'El icono es obligatorio.',
            'icon.string' => 'El icono debe ser una cadena de texto.',
            'icon.max' => 'El icono no puede tener más de 255 caracteres.',
            'icon_items.required' => 'La cantidad de items por icono es obligatoria.',
            'icon_items.integer' => 'La cantidad de items por icono debe ser un número entero.',
            'route.required' => 'La ruta es obligatoria.',
            'route.string' => 'La ruta debe ser una cadena de texto.',
            'route.max' => 'La ruta no puede tener más de 255 caracteres.',
        ];
    }
}
