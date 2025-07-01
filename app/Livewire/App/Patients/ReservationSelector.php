<?php

namespace App\Livewire\App\Patients;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalCenterDoctor;
use App\Models\Administration\MedicalSchedule;
use App\Models\Patient\Reservation;
use App\Services\Reservations\ReservationCalendarService;

class ReservationSelector extends Component
{
    public $patient;
    public $date;

    public $centers = [];
    public $areas = [];
    public $doctors = [];
    public $schedules = [];
    public $available_dates = [];

    public $medical_center_id;
    public $medical_area_id;
    public $doctor_id;
    public $medical_schedule_id;

    protected ReservationCalendarService $calendarService;

    public function boot(ReservationCalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function mount()
    {
        $this->centers = MedicalCenter::where('active', true)->get();
    }

    public function medicalAreas()
    {
        $this->reset([
            'doctor_id',
            'medical_schedule_id',
            'areas',
            'doctors',
            'schedules',
            'available_dates'
        ]);

        if (!$this->medical_center_id) return;

        $medicalCenter = MedicalCenter::with('doctors.medicalArea')->find($this->medical_center_id);

        $this->areas = $medicalCenter->doctors->map(fn($doctor) => $doctor->medicalArea)
            ->unique('id')
            ->values();
    }

    public function medicalDoctors()
    {
        $this->reset([
            'doctor_id',
            'medical_schedule_id',
            'doctors',
            'schedules',
            'available_dates',
            'date'
        ]);

        if (!$this->medical_area_id) return;

        $medicalDoctors = MedicalCenterDoctor::with(['doctor' => function ($q) {
            $q->where('medical_area_id', $this->medical_area_id)->where('active', true);
        }])->where('medical_center_id', $this->medical_center_id)
            ->get()
            ->whereNotNull('doctor');

        $this->doctors = $medicalDoctors->map(fn($item) => $item->doctor)->unique('id')->values();
        $this->loadAvailableDates();
    }

    public function medicalSchedule()
    {
        $this->reset([
            'medical_schedule_id',
        ]);

        if (!$this->medical_center_id || !$this->medical_area_id) return;

        $this->schedules = $this->calendarService->getSchedulesByDate($this->medical_center_id, $this->medical_area_id, $this->date);
    }

    public function loadAvailableDates()
    {
        $this->available_dates = $this->calendarService->getAvailableDates($this->medical_center_id, $this->medical_area_id);

        $this->dispatch('datePicker', [$this->available_dates]);
    }

    public function render()
    {
        return view('livewire.app.patients.reservation-selector');
    }
}
