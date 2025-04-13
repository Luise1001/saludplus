<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\ScheduleRequest;
use App\Models\Administration\MedicalSchedule;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;

class MedicalScheduleController extends Controller
{
    public function index()
    {
        $schedules = MedicalSchedule::with(['medicalCenter', 'medicalArea'])->get();

        return view('app.administration.medical-schedule.index', [
            'schedules' => $schedules
        ]);
    }

    public function create()
    {
        $hours = hours(24);
        $days = days();
        $centers = MedicalCenter::select('id', 'short_name')->get();
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.administration.medical-schedule.create', [
            'hours' => $hours,
            'days' => $days,
            'centers' => $centers,
            'areas' => $areas,
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        $existingSchedules = MedicalSchedule::where('medical_center_id', $request->medical_center_id)
            ->where('medical_area_id', $request->medical_area_id)
            ->where('hour', $request->hour)
            ->get();
    
        foreach ($existingSchedules as $schedule) {
            $existingDays = $schedule->days ?? [];
            $intersect = array_intersect($existingDays, $request->days);
    
            if (count($intersect) > 0) {
                return redirect()->route('medical.schedule.index')->withErrors('Ya existe un horario para alguno de los días seleccionados con esta hora.');
            }
        }
    
        MedicalSchedule::create($request->validated());
    
        return redirect()->route('medical.schedule.index')->withSuccess('Horario creado correctamente.');
    }
    
    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:medical_schedules,id',
        ]);

        $schedule = MedicalSchedule::find($id);
        $hours = hours(24);
        $days = days();
        $centers = MedicalCenter::select('id', 'short_name')->get();
        $areas = MedicalArea::select('id', 'name')->get();

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
        $schedule = MedicalSchedule::find($request->id);
        $schedule->update($request->all());

        return redirect()->route('medical.schedule.index')->withSuccess('Horario actualizado correctamente.');
    }
}
