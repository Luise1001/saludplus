<?php

namespace App\Http\Controllers\Web\App\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\ReservationRequest;
use App\Services\Reservations\Contracts\ReservationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class ReservationController extends Controller
{
    public function __construct(
        protected ReservationServiceInterface $reservationService
    ) {}

    public function reserve(ReservationRequest $request): RedirectResponse
    {
        try {
           $reservation =  $this->reservationService->create($request->validated());

            return redirect()->route('reservation.sheet', [
                'reservation' => $reservation->id
            ])->with('success', 'Cita registrada correctamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la cita.');
        }
    }

    public function confirm(int $id): RedirectResponse
    {
        try {
            $this->reservationService->confirm($id);
            return redirect()->back()->with('success', 'Cita confirmada correctamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Error al confirmar la cita.');
        }
    }

    public function cancel(int $id): RedirectResponse
    {
        try {
            $this->reservationService->cancel($id, 'Cancelada por el paciente.');
            return redirect()->back()->with('success', 'Cita cancelada.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Error al cancelar la cita.');
        }
    }
}
