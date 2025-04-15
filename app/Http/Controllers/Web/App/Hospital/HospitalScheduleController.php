<?php

namespace App\Http\Controllers\Web\App\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Hospital\ScheduleRequest;
use App\Models\Administration\MedicalSchedule;
use App\Models\Administration\MedicalArea;

class HospitalScheduleController extends Controller
{
    public function index()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $schedules = MedicalSchedule::with(['medicalCenter', 'medicalArea'])
            ->where('medical_center_id', $medical_center_id)->get();

        return view('app.hospital.medical-schedule.index', [
            'schedules' => $schedules
        ]);
    }

    public function create()
    {
        $hours = hours(24);
        $days = days();
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.hospital.medical-schedule.create', [
            'hours' => $hours,
            'days' => $days,
            'areas' => $areas,
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $existingSchedules = MedicalSchedule::where('medical_center_id', $medical_center_id)
            ->where('medical_area_id', $request->medical_area_id)
            ->where('hour', $request->hour)
            ->get();

        foreach ($existingSchedules as $schedule) {
            $existingDays = $schedule->days ?? [];
            $intersect = array_intersect($existingDays, $request->days);

            if (count($intersect) > 0) {
                return redirect()->route('hospital.schedule.index')->withErrors('Ya existe un horario para alguno de los días seleccionados con esta hora.');
            }
        }

        MedicalSchedule::create([
            'medical_center_id' => $medical_center_id,
            'medical_area_id' => $request->medical_area_id,
            'days' => $request->days,
            'hour' => $request->hour,
            'slots' => $request->slots,
            'active' => $request->active,
        ]);

        return redirect()->route('hospital.schedule.index')->withSuccess('Horario creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:medical_schedules,id',
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $schedule = MedicalSchedule::find($id);
        $hours = hours(24);
        $days = days();
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.hospital.medical-schedule.edit', [
            'schedule' => $schedule,
            'hours' => $hours,
            'days' => $days,
            'areas' => $areas,
        ]);
    }

    public function update(ScheduleRequest $request)
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $schedule = MedicalSchedule::find($request->id);
        $schedule->update($request->all());

        return redirect()->route('hospital.schedule.index')->withSuccess('Horario actualizado correctamente.');
    }
}
