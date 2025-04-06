<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\Patient;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|numeric|exists:patients,id',
        ], [
            'patient_id.required' => 'El paciente es obligatorio',
            'patient_id.numeric' => 'El paciente solo puede contener números',
            'patient_id.exists' => 'El paciente no existe',
        ]);

        $patient = Patient::find($request->patient_id);

        if (!$patient) {
            return redirect()->route('patient.index')->withSuccess('Bienvenido al registro de pacientes, por favor ingrese su información.');
        }

        return view('app.patients.reservation', [
            'patient' => $patient,
        ]);
    }

    public function reserve(Request $request)
    {
        dd($request->all());
    }

    public function sheet()
    {
        return view('app.patients.sheet');
    }
}
