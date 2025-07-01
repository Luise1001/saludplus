<?php

namespace App\Services\Reservations;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Administration\MedicalSchedule;

use function schedule_slots as ScheduleSlots;

class ReservationCalendarService
{
    public function getAvailableDates(int $medicalCenterId, int $medicalAreaId): array
    {
        $MedicalSchedules = MedicalSchedule::where('medical_center_id', $medicalCenterId)
            ->where('medical_area_id', $medicalAreaId)->where('active', true)->get();

        $schedulesIds = $MedicalSchedules->pluck('id')->toArray();
        $ScheduleDays = [];

        foreach ($MedicalSchedules as $schedule) {
            foreach ($schedule->days as $day) {
                $ScheduleDays[] = ['day' => $day, 'schedule_id' => $schedule->id];
            }
        }

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addMonth(2);
        $reservations = ScheduleSlots($medicalCenterId, $medicalAreaId, $schedulesIds, $startDate, $endDate);
        $availableDates = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {

            foreach ($ScheduleDays as $day) {
                if ($day['day'] == $date->format('l')) {

                    $reservation = $reservations->where('medical_schedule_id', $day['schedule_id'])
                        ->where('date', $date->format('Y-m-d'))->first();
                    $schedule = $MedicalSchedules->where('id', $day['schedule_id'])->first();

                    if (!isset($reservation) || $reservation->slots < $schedule->slots) {
                        $availableDates[] = $date->format('d-m-Y');
                    }
                }
            }
        }

        return $availableDates;
    }

    public function getSchedulesByDate(int $medicalCenterId, int $medicalAreaId, string $date): Collection
    {
        if (!$medicalCenterId || !$medicalAreaId) {
            return collect();
        }

        $date = Carbon::parse($date);
        $day = $date->format('l');

        return MedicalSchedule::where('medical_center_id', $medicalCenterId)
            ->where('medical_area_id', $medicalAreaId)
            ->where('active', true)
            ->get()
            ->filter(function ($schedule) use ($day) {
                return in_array($day, $schedule->days ?? []);
            });
    }
}
