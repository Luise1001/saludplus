<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;
use App\Models\Administration\Doctor;
use App\Models\Administration\MedicalSchedule;
use App\Models\Administration\MedicalCenterStaff;

class MedicalCenterSettingController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->id && auth()->user()->medicalCenter){
            $request->merge([
                'id' => auth()->user()->medicalCenter->id
            ]);
        }

        $request->validate([
            'id' => 'required|exists:medical_centers,id'
        ], [
            'id.required' => 'El id es requerido',
            'id.exists' => 'El centro médico no existe'
        ]);

        $center = MedicalCenter::with('medicalAreas', 'doctors')->where('id', $request->id)->first();
        $areas = MedicalArea::where('active', 1)->get();
        $doctors = Doctor::where('active', 1)->whereIn('medical_area_id', $center->medicalAreas->pluck('id'))->get();
        $schedules = MedicalSchedule::where('active', 1)->where('medical_center_id', $request->id)->get();
        $staff = MedicalCenterStaff::with(['staff' => function ($query) {
            $query->whereHas('role', function ($q) {
                $q->where('level', '>', auth()->user()->role->level);
            });
        }])->where('medical_center_id', $request->id)->get();

        $users = $staff->filter(function ($user) {
            return $user->staff;
        });

        return view('app.administration.medical-center.setting.index', [
            'center' => $center,
            'areas' => $areas,
            'doctors' => $doctors,
            'schedules' => $schedules,
            'users' => $users,
        ]);
    }

    public function areas(Request $request)
    {
        $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'areas' => 'required|array',
            'areas.*' => 'required|exists:medical_areas,id',
        ], [
            'medical_center_id.required' => 'El id del centro médico es requerido',
            'medical_center_id.exists' => 'El centro médico no existe',
            'areas.required' => 'Las áreas son requeridas',
            'areas.array' => 'Las áreas deben ser un arreglo',
            'areas.*.required' => 'El id del área es requerido',
            'areas.*.exists' => 'El área no existe',
        ]);

        MedicalCenter::find($request->medical_center_id)->medicalAreas()->sync($request->areas);

        return redirect()->back()->withSuccess('Las áreas han sido asignadas correctamente');
    }

    public function doctors(Request $request)
    {
        $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'doctors' => 'required|array',
            'doctors.*' => 'required|exists:doctors,id',
        ], [
            'medical_center_id.required' => 'El id del centro médico es requerido',
            'medical_center_id.exists' => 'El centro médico no existe',
            'doctors.required' => 'Los doctores son requeridos',
            'doctors.array' => 'Los doctores deben ser un arreglo',
            'doctors.*.required' => 'El id del doctor es requerido',
            'doctors.*.exists' => 'El doctor no existe',
        ]);

        MedicalCenter::find($request->medical_center_id)->doctors()->sync($request->doctors);

        return redirect()->back()->withSuccess('Los especialistas han sido asignados correctamente');
    }
}
