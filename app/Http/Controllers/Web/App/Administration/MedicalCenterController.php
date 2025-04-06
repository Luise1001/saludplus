<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\MedicalCenterRequest;
use App\Models\Administration\MedicalCenter;
use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;

class MedicalCenterController extends Controller
{
  public function index()
  {
    $centers = MedicalCenter::all();

    return view('app.administration.medical-center.index', [
      'centers' => $centers
    ]);
  }

  public function create()
  {
    $states = State::all();
    $municipalities = Municipality::all();
    $parishes = Parish::all();

    return view('app.administration.medical-center.create', [
      'states' => $states,
      'municipalities' => $municipalities,
      'parishes' => $parishes,
    ]);
  }

  public function store(MedicalCenterRequest $request)
  {
    $active = $request->active ? 1 : 0;
    $request->merge(['active' => $active]);

    MedicalCenter::create($request->all());

    return redirect()->route('medical.center.index')->withSuccess('Centro médico creado con éxito.');
  }

  public function edit(Request $request, $id)
  {
    $request->merge(['id' => $id]);

    $request->validate([
      'id' => 'required|exists:medical_centers,id'
    ], [
      'id.required' => 'El id es requerido',
      'id.exists' => 'El centro médico no existe'
    ]);

    $center = MedicalCenter::find($id);
    $states = State::all();
    $municipalities = Municipality::all();
    $parishes = Parish::all();

    return view('app.administration.medical-center.edit', [
      'center' => $center,
      'states' => $states,
      'municipalities' => $municipalities,
      'parishes' => $parishes,
    ]);
  }

  public function update(MedicalCenterRequest $request)
  {
    $active = $request->active ? 1 : 0;
    $request->merge(['active' => $active]);

    $center = MedicalCenter::find($request->id);
    $center->update($request->all());

    return redirect()->route('medical.center.index')->withSuccess('Centro médico editado con éxito.');
  }
  
}
