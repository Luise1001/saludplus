<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient\Reservation;

class ReservationSheetController extends Controller
{
    public function __invoke(Reservation $reservation)
    {
        $reservation->load([
            'patient',
            'patient.state',
            'patient.municipality',
            'patient.parish',
            'medicalCenter',
            'medicalArea',
            'doctor',
            'medicalSchedule',
            'user'
        ]);

        return view('app.patients.sheet', [
            'reservation' => $reservation
        ]);
    }
}
