<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\Reservation;


class CenterReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('patient', 'doctor', 'medicalCenter', 'medicalSchedule', 'user')->get();


        return view('app.administration.reservation.index', [
            'reservations' => $reservations,
        ]);
    }

    public function confirm(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        
        $request->validate([
            'id' => 'required|exists:reservations,id',
        ], [
            'id.required' => 'El ID es requerido.',
            'id.exists' => 'El ID no existe en la base de datos.'
        ]);

        $reservation = Reservation::find($request->id);

        if($reservation->status != 'pendiente'){
            return redirect()->back()->withErrors('La cita ya ha sido procesada.');
        }

        $reservation->update([
            'status' => 'procesado',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->withSuccess('Cita confirmada correctamente.');
    }

    public function cancel(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|exists:reservations,id',
        ], [
            'id.required' => 'El ID es requerido.',
            'id.exists' => 'El ID no existe en la base de datos.'
        ]);

        $reservation = Reservation::find($request->id);

        if($reservation->status != 'pendiente'){
            return redirect()->back()->withErrors('La cita ya ha sido procesada.');
        }

        $reservation->update([
            'status' => 'cancelado',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->withSuccess('Cita cancelada correctamente.');
    }
}
