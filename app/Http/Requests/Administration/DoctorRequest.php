<?php

namespace App\Http\Requests\Administration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document' => [
                'required',
                'string',
                'max:255',
                Rule::unique('doctors', 'document')->ignore($this->id),
            ],
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'medical_area_id' => [
                'required',
                'exists:medical_areas,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'document.required' => 'El documento es obligatorio.',
            'document.unique' => 'El documento ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'medical_area_id.required' => 'El área de atención es obligatoria.',
            'medical_area_id.exists' => 'El área de atención seleccionada no es válida.',
        ];
    }
}
