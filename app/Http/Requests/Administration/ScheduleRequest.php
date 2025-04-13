<?php

namespace App\Http\Requests\Administration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
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
            'medical_center_id' => 'required|integer|exists:medical_centers,id',
            'medical_area_id' => 'required|integer|exists:medical_areas,id',
            'days' => 'required|array|min:1',
            'days.*' => ['required', 'string'], 
            'hour' => 'required|date_format:H:i',
            'slots' => 'required|integer|min:1|max:100',
            'active' => 'nullable|boolean',
        ];
    }
    

    public function messages()
    {
        return [
            'medical_center_id.required' => 'El centro médico es obligatorio.',
            'medical_area_id.required' => 'El área médica es obligatoria.',
            'medical_center_id.exists' => 'El centro médico no existe.',
            'medical_area_id.exists' => 'El área médica no existe.',
            'days.required' => 'Debe seleccionar al menos un día.',
            'days.array' => 'El campo días debe ser un arreglo.',
            'days.min' => 'Debe seleccionar al menos un día.',
            'days.*.required' => 'El campo día es obligatorio.',
            'days.*.string' => 'Cada día debe ser una cadena de texto.',
            'hour.required' => 'El campo hora es obligatorio.',
            'hour.date_format' => 'La hora debe estar en formato HH:mm.',
            'slots.required' => 'El campo número de citas es obligatorio.',
            'slots.integer' => 'El número de citas debe ser un número entero.',
            'slots.min' => 'Debe permitir al menos una cita.',
            'slots.max' => 'No puede permitir más de 100 citas.',
            'active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
    
}
