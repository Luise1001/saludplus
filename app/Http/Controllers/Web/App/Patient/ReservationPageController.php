<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\Patient;

class ReservationPageController extends Controller
{
    public function __invoke(Patient $patient)
    {
        return view('app.patients.reservation', [
            'patient' => $patient
        ]);
    }
}
