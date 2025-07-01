<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Patient\PatientRequest;
use App\Services\Patient\Contracts\PatientServiceInterface;

class PatientController extends Controller
{
    public function __construct(protected PatientServiceInterface $patientService) {}

    public function index(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
        ], [
            'patient_id.required' => 'El ID del paciente es obligatorio',
            'patient_id.integer' => 'El ID del paciente debe ser un número entero',
            'patient_id.exists' => 'El ID del paciente no existe',
        ]);

        $patient = $this->patientService->findById($request->input('patient_id'));

        if (!$patient) {
            return redirect()->route('patient.index')->withErrors('Bienvenido al registro de pacientes, por favor ingrese su información.');
        }

        return view('app.patients.reservation', [
            'patient' => $patient,
        ]);
    }

    public function register(PatientRequest $request)
    {
        $validated = $request->validated();

        $patient = $this->patientService->create($validated);

        return redirect()->route('reservation.index', ['patient' => $patient->id]);
    }
}
