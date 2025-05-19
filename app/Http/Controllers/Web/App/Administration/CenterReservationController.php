<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\Reservation;
use App\Models\Administration\MedicalCenter;

class CenterReservationController extends Controller
{
    public function index()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No se ha seleccionado un centro médico.');
        }

        $reservations = Reservation::with('patient', 'doctor', 'medicalCenter', 'medicalSchedule', 'user')
            ->where('medical_center_id', $medical_center_id)
            ->where('status', 'pendiente')
            ->where('date', '>=', now())
            ->get();

        $medicalCenter = MedicalCenter::where('id', $medical_center_id)->with(['medicalAreas' => function ($query) {
            $query->where('active', true);
        }])->get();

        $areas = $medicalCenter->pluck('medicalAreas')->flatten();

        return view('app.hospital.reservation.index', [
            'reservations' => $reservations,
            'date' => now()->format('d-m-Y'),
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

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No se ha seleccionado un centro médico.');
        }

        $dates = date_range($request->date, true);
        $from = $dates['from'];
        $to = $dates['to'];

        $reservations = Reservation::with('patient', 'doctor', 'medicalCenter', 'medicalArea', 'medicalSchedule', 'user')
            ->where('medical_center_id', $medical_center_id)
            ->whereBetween('date', [$from, $to])
            ->when($request->medical_area_id, function ($query) use ($request) {
                return $query->where('medical_area_id', $request->medical_area_id);
            })
            ->get();

        $medicalCenter = MedicalCenter::where('id', $medical_center_id)->with(['medicalAreas' => function ($query) {
            $query->where('active', true);
        }])->get();

        $areas = $medicalCenter->pluck('medicalAreas')->flatten();


        return view('app.hospital.reservation.index', [
            'reservations' => $reservations,
            'date' => $request->date,
            'areas' => $areas,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:reservations,id',
        ], [
            'id.required' => 'El ID es requerido.',
            'id.exists' => 'El ID no existe en la base de datos.'
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No se ha seleccionado un centro médico.');
        }

        $reservation = Reservation::find($request->id);

        if ($reservation->status != 'pendiente') {
            return redirect()->back()->withErrors('La cita ya ha sido procesada.');
        }

        $reservation->update([
            'status' => 2,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->withSuccess('Cita confirmada correctamente.');
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:reservations,id',
        ], [
            'id.required' => 'El ID es requerido.',
            'id.exists' => 'El ID no existe en la base de datos.'
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No se ha seleccionado un centro médico.');
        }

        $reservation = Reservation::find($request->id);

        if ($reservation->status != 'pendiente') {
            return redirect()->back()->withErrors('No se pudo cancelar la cita, porque ya ha sido procesada.');
        }

        $reservation->update([
            'status' => 3,
            'observation' => 'Cancelada por el hospital',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->withSuccess('Cita cancelada correctamente.');
    }
}
