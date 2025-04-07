<?php

namespace App\Services\Schedule;

use Carbon\Carbon;
use App\Models\Patient\Reservation;

class ScheduleService
{
    public function hours(int $format)
    {
        $hours = collect();
        $start = Carbon::createFromTime(0, 0);

        for ($i = 0; $i < $format; $i++) {
            $hours->push($start->format('H:i'));
            $start->addHour();
        }

        return $hours;
    }

    public function days()
    {
        return [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];
    }

    public function ScheduleSlots($medical_center_id, $medical_area_id, $scheduleIds, $startDate, $endDate)
    {
        $reservations = Reservation::where('medical_center_id', $medical_center_id)
            ->where('medical_area_id', $medical_area_id)
            ->whereIn('medical_schedule_id', $scheduleIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->selectRaw('medical_schedule_id, COUNT(*) as slots')
            ->selectRaw('date')
            ->groupBy('date', 'medical_schedule_id')
            ->get();

        return $reservations;
    }
}
