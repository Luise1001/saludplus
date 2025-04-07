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
            'day' => [
                'required',
                'string',
                Rule::unique('medical_schedules', 'day')
                    ->where(function ($query) {
                        return $query->where('medical_center_id', $this->medical_center_id)
                            ->where('medical_area_id', $this->medical_area_id)
                            ->where('hour', $this->hour);
                    })->ignore($this->id)
            ],
            'hour' => 'required|date_format:H:i',
            'slots' => 'required|integer|min:1|max:100',
            'active' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'medical_center_id.required' => 'El centro médico es obligatorio.',
            'medical_area_id.required' => 'El área médica es obligatorio.',
            'day.required' => 'El campo día es obligatorio.',
            'day.unique' => 'El día ya está registrado para este centro médico, ésta área y ésta hora.',
            'hour.required' => 'El campo hora es obligatorio.',
            'slots.required' => 'El campo número de citas es obligatorio.',
            'active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
