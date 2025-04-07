<?php

use Carbon\Carbon;
use App\Models\Patient\Reservation;

if (!function_exists('hours')) {
    function hours(int $format)
    {
        $hours = collect();
        $start = Carbon::createFromTime(0, 0);

        for ($i = 0; $i < $format; $i++) {
            $hours->push($start->format('H:i'));
            $start->addHour();
        }

        return $hours;
    }
}

if (!function_exists('days')) {
    function days()
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
}

if (!function_exists('day')) {
    function day($day)
    {
        $days = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];

        return $days[$day] ?? null;
    }
}

if (!function_exists('schedule_slots')) {
    function schedule_slots($medical_center_id, $medical_area_id, $scheduleIds, $startDate, $endDate)
    {
        return Reservation::where('medical_center_id', $medical_center_id)
            ->where('medical_area_id', $medical_area_id)
            ->whereIn('medical_schedule_id', $scheduleIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'pendiente')
            ->selectRaw('medical_schedule_id, COUNT(*) as slots')
            ->selectRaw('date')
            ->groupBy('date', 'medical_schedule_id')
            ->get();
    }
}
