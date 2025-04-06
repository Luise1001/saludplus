<?php

namespace App\Services\Schedule;

use Carbon\Carbon;

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
            'Lunes' => 'Lunes',
            'Martes' => 'Martes',
            'Miercoles' => 'Miércoles',
            'Jueves' => 'Jueves',
            'Viernes' => 'Viernes',
            'Sabado' => 'Sábado',
            'Domingo' => 'Domingo'
        ];
    }

    public function englishDays($days)
    {
        return collect($days)->map(function ($day) {
            switch ($day) {
                case 'Lunes':
                    return 'Monday';
                case 'Martes':
                    return 'Tuesday';
                case 'Miercoles':
                    return 'Wednesday';
                case 'Jueves':
                    return 'Thursday';
                case 'Viernes':
                    return 'Friday';
                case 'Sabado':
                    return 'Saturday';
                case 'Domingo':
                    return 'Sunday';
            }
        });
    }
}
