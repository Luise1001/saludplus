<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\MedicalAreaRequest;
use App\Models\Administration\MedicalArea;

class MedicalAreaController extends Controller
{
    public function index()
    {
        $areas = MedicalArea::all();

        return view('app.administration.medical-area.index', [
            'areas' => $areas,
        ]);
    }

    public function create()
    {
        return view('app.administration.medical-area.create');
    }

    public function store(MedicalAreaRequest $request)
    {
        $active = $request->active ?? 0;
        $request->merge(['active' => $active]);

        MedicalArea::create($request->validated());

        return redirect()->route('medical.area.index')->withSuccess('Área de atención creada exitosamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:medical_areas,id',
        ], [
            'id.required' => 'El ID es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El área de atención no existe.',
        ]);

        $area = MedicalArea::find($request->id);

        return view('app.administration.medical-area.edit', [
            'area' => $area,
        ]);
    }

    public function update(MedicalAreaRequest $request)
    {
        $active = $request->active ?? 0;
        $request->merge(['active' => $active]);

        $area = MedicalArea::find($request->id);
        $area->update($request->all());

        return redirect()->route('medical.area.index')->withSuccess('Área de atención actualizada exitosamente.');
    }
}
