<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient\Reservation;
use App\Models\Patient\Patient;
use App\Models\Administration\MedicalArea;

class PatientReservationController extends Controller
{
    public function history()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        if (!$patient) {
            return redirect()->route('patient.index')->withSuccess('Bienvenido al registro de pacientes, por favor ingrese su información.');
        }

        $reservations = Reservation::with('doctor', 'medicalCenter', 'medicalArea', 'medicalSchedule', 'user')
            ->where('patient_id', $patient->id)->orderBy('date', 'desc')->get();

        $areaIds = $reservations->pluck('medical_area_id')->unique();
        $areas = MedicalArea::whereIn('id', $areaIds)->select('id', 'name')->get();

        return view('app.patients.reservation-history.index', [
            'patient' => $patient,
            'reservations' => $reservations,
            'areas' => $areas,
        ]);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'date' => 'required|string',
            'medical_area_id' => 'nullable|exists:medical_areas,id',
        ], [
            'date.required' => 'La fecha es requerida.',
            'date.string' => 'La fecha debe ser una cadena de texto.',
            'medical_area_id.exists' => 'El área médica seleccionada no existe en la base de datos.',
        ]);

        $dates = date_range($request->date, true);
        $from = $dates['from'];
        $to = $dates['to'];
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        if (!$patient) {
            return redirect()->route('patient.index')->withSuccess('Bienvenido al registro de pacientes, por favor ingrese su información.');
        }

        $reservations = Reservation::with('doctor', 'medicalCenter', 'medicalSchedule', 'user')
            ->where('patient_id', $patient->id)
            ->whereBetween('date', [$from, $to])
            ->when($request->medical_area_id, function ($query) use ($request) {
                return $query->where('medical_area_id', $request->medical_area_id);
            })
            ->get();
        $areaIds = $reservations->pluck('medical_area_id')->unique();
        $areas = MedicalArea::whereIn('id', $areaIds)->select('id', 'name')->get();


        return view('app.patients.reservation-history.index', [
            'reservations' => $reservations,
            'date' => $request->date,
            'areas' => $areas,
        ]);
    }

    public function reserve()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        if (!$patient) {
            return redirect()->route('patient.index')->withSuccess('Bienvenido al registro de pacientes, por favor ingrese su información.');
        }

        return view('app.patients.reservation', [
            'patient' => $patient,
        ]);
    }
}
