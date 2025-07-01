<?php

namespace App\Services\Reservations\Contracts;

interface ReservationServiceInterface
{
    public function create(array $data);
    public function confirm(int $reservationId);
    public function cancel(int $reservationId, ?string $reason = null);
}
