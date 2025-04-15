<?php

namespace App\Http\Controllers\Web\App\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Hospital\DoctorRequest;
use App\Models\Administration\Doctor;
use App\Models\Administration\MedicalCenterDoctor;
use App\Models\Administration\MedicalArea;

class HospitalDoctorController extends Controller
{

    public function index()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $MedicalCenterDoctor = MedicalCenterDoctor::with('doctor')->where('medical_center_id', $medical_center_id)->get();
        $doctors = $MedicalCenterDoctor->map(function ($doctor) {
            return $doctor->doctor;
        });

        return view('app.hospital.doctors.index', [
            'doctors' => $doctors
        ]);
    }

    public function create()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.hospital.doctors.create', [
            'areas' => $areas,
        ]);
    }

    public function store(DoctorRequest $request)
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $doctor = Doctor::create($request->validated());

        MedicalCenterDoctor::create([
            'medical_center_id' => $medical_center_id,
            'doctor_id' => $doctor->id,
        ]);

        return redirect()->route('hospital.doctor.index')->withSuccess('Especialista creado con éxito.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|exists:doctors,id',
        ], [
            'id.required' => 'El ID del especialista es requerido.',
            'id.exists' => 'El especialista no existe.',
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $medicalCenterDoctor = MedicalCenterDoctor::where('doctor_id', $id)->where('medical_center_id', '!=', $medical_center_id)->first();

        if ($medicalCenterDoctor) {
            return redirect()->back()->withErrors('El especialista tiene otros hospitales asignados, por lo que no puede ser modificado por ninguno de ellos.');
        }

        $doctor = Doctor::find($id);
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.hospital.doctors.edit', [
            'doctor' => $doctor,
            'areas' => $areas,
        ]);
    }

    public function update(DoctorRequest $request)
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $medicalCenterDoctor = MedicalCenterDoctor::where('doctor_id', $request->id)->where('medical_center_id', '!=', $medical_center_id)->first();

        if ($medicalCenterDoctor) {
            return redirect()->back()->withErrors('El especialista tiene otros hospitales asignados, por lo que no puede ser modificado por ninguno de ellos.');
        }

        $doctor = Doctor::find($request->id);
        $doctor->update($request->all());

        return redirect()->route('hospital.doctor.index')->withSuccess('Especialista actualizado con éxito.');
    }
}
