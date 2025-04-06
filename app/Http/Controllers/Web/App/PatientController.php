<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Patient\PatientRequest;
use App\Models\Patient\Patient;
use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'document' => 'nullable|numeric'
        ], [
            'document.numeric' => 'El documento solo puede contener números',
        ]);

        $document = request()->input('document');
        $patient = Patient::where('document', $document)->first();

        if ($patient) {
            return redirect()->route('reservation.index', [
                'patient_id' => $patient->id
            ]);
        }

        $states = State::all();
        $municipalities = Municipality::all();
        $parishes = Parish::all();

        return view('app.patients.register', [
            'document' => $document,
            'states' => $states,
            'municipalities' => $municipalities,
            'parishes' => $parishes,
        ]);
    }

    public function register(PatientRequest $request)
    {
        $patient = Patient::create($request->validated());

        return redirect()->route('reservation.index', [
            'patient_id' => $patient->id
        ])->withSuccess('Paciente registrado exitosamente, proceda a reservar su cita.');
    }
}
