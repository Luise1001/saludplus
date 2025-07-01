<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Patient\Contracts\PatientServiceInterface;

class PatientPageController extends Controller
{
    protected $patientService;

    public function __construct(PatientServiceInterface $patientService)
    {
        $this->patientService = $patientService;
    }

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'document' => 'nullable|numeric',
        ], [
            'document.numeric' => 'El documento solo puede contener números',
        ]);

        $document = $validated['document'] ?? '';

        if ($document !== '') {
            $patient = $this->patientService->findByDocument($document);

            if ($patient) {
                return redirect()->route('reservation.index', ['patient' => $patient->id])
                    ->with('message', 'Bienvenido de nuevo, por favor agende su cita.');
            }
        }

        return view('app.patients.register', [
            'document' => $document,
        ]);
    }
}
