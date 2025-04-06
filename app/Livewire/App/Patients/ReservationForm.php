<?php

namespace App\Livewire\App\Patients;

use Livewire\Component;
use Carbon\Carbon;
use App\Services\Schedule\ScheduleService;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalCenterDoctor;
use App\Models\Administration\MedicalSchedule;

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
        if(!$this->medical_center_id || !$this->medical_area_id) {
            return;
        }

        $this->schedules = MedicalSchedule::where('medical_center_id', $this->medical_center_id)
            ->where('medical_area_id', $this->medical_area_id)
            ->where('active', true)
            ->get();
    }

    public function loadAvailableDates()
    {
        $scheduleService = new ScheduleService();
        $MedicalSchedules = MedicalSchedule::where('medical_center_id', $this->medical_center_id)
            ->where('medical_area_id', $this->medical_area_id)
            ->where('active', true)
            ->get();

        $ScheduleDays = [];

        foreach ($MedicalSchedules as $schedule) {;
            $ScheduleDays[] = $schedule->day;
        }

        $ScheduleDays = $scheduleService->englishDays($ScheduleDays)->toArray();
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addMonth(2);
        $availableDates = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            if (in_array($date->format('l'), $ScheduleDays)) {

                $availableDates[] = $date->format('Y-m-d');
            }
        }

        $this->dispatch('datePicker', [$availableDates]);
    }

    public function render()
    {
        return view('livewire.app.patients.reservation-form');
    }
}
