<?php

namespace App\Livewire\App\Patients;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalCenterDoctor;
use App\Models\Administration\MedicalSchedule;
use function schedule_slots as ScheduleSlots;

class ReservationForm extends Component
{
    public $patient;
    public $date;

    public $centers;
    public $areas;
    public $doctors;
    public $schedules;

    public $medical_center_id;
    public $medical_area_id;
    public $doctor_id;
    public $medical_schedule_id;

    public function mount()
    {
        $this->centers = MedicalCenter::where('active', true)->get();
    }

    public function MedicalCenter()
    {
        if (!$this->medical_center_id) {
            return;
        }

        $medicalCenter = MedicalCenter::with('doctors.medicalArea')->find($this->medical_center_id);
        $this->areas = $medicalCenter->doctors->map(function ($doctor) {
            return $doctor->medicalArea;
        })->unique();

        $this->medical_area_id = null;
        $this->doctor_id = null;
        $this->medical_schedule_id = null;
        $this->schedules = null;
    }

    public function MedicalArea()
    {
        if (!$this->medical_area_id) {
            return;
        }

        $medicalDoctors = MedicalCenterDoctor::with(['doctor' => function ($query) {
            $query->where('medical_area_id', $this->medical_area_id)
                ->where('active', true);
        }])->where('medical_center_id', $this->medical_center_id)->get()->whereNotNull('doctor');

        $this->doctors = $medicalDoctors->map(function ($doctor) {
            return $doctor->doctor;
        })->unique();

        $this->doctor_id = null;
        $this->medical_schedule_id = null;
        $this->schedules = null;

        $this->loadAvailableDates();
    }

    public function MedicalSchedule()
    {
        if (!$this->medical_center_id || !$this->medical_area_id) {
            return;
        }

        $date = Carbon::parse($this->date);
        $day = $date->format('l');

        $this->schedules = MedicalSchedule::where('medical_center_id', $this->medical_center_id)
            ->where('medical_area_id', $this->medical_area_id)
            ->where('active', true)
            ->get()
            ->filter(function ($schedule) use ($day) {
                return in_array($day, $schedule->days ?? []);
            });
    }


    public function loadAvailableDates()
    {
        $MedicalSchedules = MedicalSchedule::where('medical_center_id', $this->medical_center_id)
            ->where('medical_area_id', $this->medical_area_id)->where('active', true)->get();

        $schedulesIds = $MedicalSchedules->pluck('id')->toArray();
        $ScheduleDays = [];
        foreach ($MedicalSchedules as $schedule) {
            foreach ($schedule->days as $day) {
                $ScheduleDays[] = ['day' => $day, 'schedule_id' => $schedule->id];
            }
        }

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addMonth(2);
        $reservations = ScheduleSlots($this->medical_center_id, $this->medical_area_id, $schedulesIds, $startDate, $endDate);
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

        $this->dispatch('datePicker', [$availableDates]);
    }

    public function render()
    {
        return view('livewire.app.patients.reservation-form');
    }
}
