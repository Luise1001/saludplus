<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\DoctorRequest;
use App\Models\Administration\MedicalArea;
use App\Models\Administration\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('medicalArea')->get();

        return view('app.administration.doctors.index', [
            'doctors' => $doctors,
        ]);
    }

    public function create()
    {
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.administration.doctors.create', [
            'areas' => $areas,
        ]);
    }

    public function store(DoctorRequest $request)
    {
        Doctor::create($request->validated());

        return redirect()->route('doctor.index')->withSuccess('Especialista creado con éxito.');
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

        $doctor = Doctor::find($id);
        $areas = MedicalArea::select('id', 'name')->get();

        return view('app.administration.doctors.edit', [
            'doctor' => $doctor,
            'areas' => $areas,
        ]);
    }

    public function update(DoctorRequest $request)
    {
        $doctor = Doctor::find($request->id);
        $doctor->update($request->all());

        return redirect()->route('doctor.index')->withSuccess('Especialista actualizado con éxito.');
    }
}
