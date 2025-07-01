<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
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
        if ($this->has('date')) {
            $this->merge([
                'date' => Carbon::parse($this->date)->format('Y-m-d')
            ]);
        }

        return [
            'patient_id' => ['required', 'numeric', 'exists:patients,id'],
            'medical_center_id' => ['required', 'numeric', 'exists:medical_centers,id'],
            'medical_area_id' => ['required', 'numeric', 'exists:medical_areas,id'],
            'doctor_id' => ['required', 'numeric', 'exists:doctors,id'],
            'reason' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'medical_schedule_id' => ['required', 'numeric', 'exists:medical_schedules,id'],
            'observation' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'El paciente es obligatorio',
            'patient_id.numeric' => 'El paciente solo puede contener números',
            'patient_id.exists' => 'El paciente no existe',
            'medical_center_id.required' => 'El centro médico es obligatorio',
            'medical_center_id.numeric' => 'El centro médico solo puede contener números',
            'medical_center_id.exists' => 'El centro médico no existe',
            'medical_area_id.required' => 'El área de atención es obligatoria',
            'medical_area_id.numeric' => 'El área de atención solo puede contener números',
            'medical_area_id.exists' => 'El área de atención no existe',
            'doctor_id.required' => 'El especialista es obligatorio',
            'doctor_id.numeric' => 'El especialista solo puede contener números',
            'doctor_id.exists' => 'El especialista no existe',
            'reason.required' => 'El motivo es obligatorio',
            'reason.string' => 'El motivo solo puede contener letras y números',
            'reason.max' => 'El motivo no puede tener más de 255 caracteres',
            'date.required' => 'La fecha es obligatoria',
            'date.date' => 'La fecha no es válida',
            'date.date_format' => 'La fecha no tiene el formato correcto',
            'date.after_or_equal' => 'La fecha debe ser igual o posterior a hoy',
            'medical_schedule_id.required' => 'El horario es obligatorio',
            'medical_schedule_id.numeric' => 'El horario solo puede contener números',
            'medical_schedule_id.exists' => 'El horario no existe',
        ];
    }
}
