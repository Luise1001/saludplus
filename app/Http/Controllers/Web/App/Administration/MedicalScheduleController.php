<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\ScheduleRequest;
use App\Services\Schedule\ScheduleService;
use App\Models\Administration\MedicalSchedule;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;

class MedicalScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        $schedules = MedicalSchedule::with(['medicalCenter', 'medicalArea'])->get();

        return view('app.administration.medical-schedule.index', [
            'schedules' => $schedules
        ]);
    }

    public function create()
    {
        $hours = $this->scheduleService->hours(24);
        $days = $this->scheduleService->days();
        $centers = MedicalCenter::all();
        $areas = MedicalArea::all();

        return view('app.administration.medical-schedule.create', [
            'hours' => $hours,
            'days' => $days,
            'centers' => $centers,
            'areas' => $areas,
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        $active = $request->active ? 1 : 0;
        $request->merge(['active' => $active]);

        MedicalSchedule::create($request->all());

        return redirect()->route('medical.schedule.index')->withSuccess('Horario creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:medical_schedules,id',
        ]);

        $schedule = MedicalSchedule::find($id);
        $hours = $this->scheduleService->hours(24);
        $days = $this->scheduleService->days();
        $centers = MedicalCenter::all();
        $areas = MedicalArea::all();

        return view('app.administration.medical-schedule.edit', [
            'schedule' => $schedule,
            'hours' => $hours,
            'days' => $days,
            'centers' => $centers,
            'areas' => $areas,
        ]);
    }

    public function update(ScheduleRequest $request)
    {
        $active = $request->active ? 1 : 0;
        $request->merge(['active' => $active]);
        
        $schedule = MedicalSchedule::find($request->id);
        $schedule->update($request->all());

        return redirect()->route('medical.schedule.index')->withSuccess('Horario actualizado correctamente.');
    }
}
