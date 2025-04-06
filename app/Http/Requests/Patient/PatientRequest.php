<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
                'numeric',
                Rule::unique('patients', 'document')->ignore($this->id)
            ],
            'birth_date' => 'required|date_format:d-m-Y',
            'email' => [
                'required',
                'email',
                Rule::unique('patients', 'email')->ignore($this->id)
            ],
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:120',
            'state_id' => 'required|exists:states,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'parish_id' => 'required|exists:parishes,id',
            'sector' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'last_name.required' => 'El apellido es obligatorio',
            'document.required' => 'La cédula es obligatoria',
            'document.numeric' => 'La cédula solo puede contener números',
            'document.unique' => 'La cédula ya está registrada',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria',
            'birth_date.date_format' => 'El formato de la fecha de nacimiento no es válido',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico no es válido',
            'email.unique' => 'El correo electrónico ya está registrado',
            'phone.required' => 'El teléfono es obligatorio',
            'age.required' => 'La edad es obligatoria',
            'age.integer' => 'La edad debe ser un número entero',
            'age.min' => 'La edad debe ser al menos 1 año',
            'age.max' => 'La edad no puede ser mayor a 120 años',
            'state_id.required' => 'El estado es obligatorio',
            'municipality_id.required' => 'El municipio es obligatorio',
            'parish_id.required' => 'La parroquia es obligatoria',
            'sector.required' => 'El sector es obligatorio'
        ];
    }
}
