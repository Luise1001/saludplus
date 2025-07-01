<?php

namespace App\Services\Reservations;

use App\Services\Reservations\Contracts\ReservationServiceInterface;
use App\Models\Patient\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationService implements ReservationServiceInterface
{
    public function create(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {

            $exists = Reservation::where('patient_id', $data['patient_id'])
                ->where('medical_center_id', $data['medical_center_id'])
                ->where('medical_area_id', $data['medical_area_id'])
                ->where('status', 'pendiente')
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'duplicated' => 'Ya tiene una cita pendiente para este centro médico en esa área.'
                ]);
            }

            return Reservation::create([
                'patient_id' => $data['patient_id'],
                'medical_center_id' => $data['medical_center_id'],
                'medical_area_id' => $data['medical_area_id'],
                'doctor_id' => $data['doctor_id'],
                'medical_schedule_id' => $data['medical_schedule_id'],
                'date' => $data['date'],
                'reason' => $data['reason'] ?? null,
                'observation' => $data['observation'] ?? null,
                'status' => 'pendiente',
                'user_id' => $data['user_id'] ?? null,
            ]);
        });
    }

    public function confirm(int $id): Reservation
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status !== 'pendiente') {
            throw ValidationException::withMessages([
                'status' => 'Solo se pueden confirmar citas pendientes.'
            ]);
        }

        $reservation->update([
            'status' => 'confirmada',
            'user_id' => auth()->id()
        ]);

        return $reservation;
    }

    public function cancel(int $id, ?string $reason = null): Reservation
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status !== 'pendiente') {
            throw ValidationException::withMessages([
                'status' => 'No se puede cancelar una cita ya confirmada o cancelada.'
            ]);
        }

        $reservation->update([
            'status' => 'cancelada',
            'observation' => trim(($reservation->observation ?? '') . ' ' . $reason),
            'user_id' => auth()->id()
        ]);

        return $reservation;
    }
}
