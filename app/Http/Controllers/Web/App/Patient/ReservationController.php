<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Patient\ReservationRequest;
use App\Models\Patient\Patient;
use App\Models\Patient\Reservation;

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

    public function reserve(ReservationRequest $request)
    {
        $reservation = Reservation::where('patient_id', $request->patient_id)
            ->where('medical_center_id', $request->medical_center_id)
            ->where('medical_area_id', $request->medical_area_id)
            ->where('status', 'pendiente')
            ->first();

        if ($reservation) {
            return redirect()->back()->withErrors('Usted ya tiene una cita pendiente para este centro médico en esa área.');
        }

        $new = Reservation::create($request->validated());

        $reservation = Reservation::with([
            'patient',
            'patient.state',
            'patient.municipality',
            'patient.parish',
            'medicalCenter',
            'medicalCenter.state',
            'medicalCenter.municipality',
            'medicalCenter.parish',
            'medicalArea',
            'doctor',
            'medicalSchedule'
        ])->find($new->id);

        return view('app.patients.sheet', [
            'reservation' => $reservation
        ]);
    }

}
