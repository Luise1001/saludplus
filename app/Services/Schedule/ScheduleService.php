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
            ->whereIn('status', ['pendiente', 'procesado'])
            ->selectRaw('medical_schedule_id, COUNT(*) as slots')
            ->selectRaw('date')
            ->groupBy('date', 'medical_schedule_id')
            ->get();
    }
}

if (!function_exists('date_range')) {
    function date_range($dateRange, $hour = false)
    {
        if (strpos($dateRange, ' to ') !== false) {
            list($from, $to) = explode(' to ', $dateRange);
        } else {
            $from = $to = $dateRange;
        }

        $from = Carbon::createFromFormat('d-m-Y', $from)->format('Y-m-d');
        $to = Carbon::createFromFormat('d-m-Y', $to)->format('Y-m-d');

        if ($hour) {
            $from = $from . ' 00:00:00';
            $to = $to . ' 23:59:59';
        }

        return ['from' => $from, 'to' => $to];
    }
}
