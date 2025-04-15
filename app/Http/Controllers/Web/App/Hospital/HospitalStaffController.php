<?php

namespace App\Http\Controllers\Web\App\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Hospital\StaffRequest;
use App\Models\Administration\MedicalCenterStaff;
use App\Models\Role;
use App\Models\User;

class HospitalStaffController extends Controller
{
    public function index()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $staff = MedicalCenterStaff::with(['staff' => function ($query) {
            $query->whereHas('role', function ($q) {
                $q->where('level', '>', auth()->user()->role->level);
            });
        }])->where('medical_center_id', $medical_center_id)->get();

        $users = $staff->filter(function ($user) {
            return $user->staff;
        });

        return view('app.hospital.staff.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $roles = Role::select('id', 'display_name')->where('level', '>', auth()->user()->role->level)->get();

        return view('app.hospital.staff.create', [
            'roles' => $roles,
        ]);
    }

    public function store(StaffRequest $request)
    {
        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        MedicalCenterStaff::create([
            'user_id' => $user->id,
            'medical_center_id' => $medical_center_id,
        ]);

        return redirect()->route('hospital.staff.index')->withSuccess('El usuario ha sido creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => 'required|exists:users,id',
        ], [
            'id.required' => 'El campo id es obligatorio.',
            'id.exists' => 'El usuario no existe en la base de datos.',
        ]);

        $request->validate([
            'id' => 'required|exists:medical_center_staff,user_id',
        ], [
            'id.required' => 'El campo id es obligatorio.',
            'id.exists' => 'El usuario no existe.',
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $staff = MedicalCenterStaff::with(['staff', 'medicalCenter'])
            ->where('medical_center_id', '!=', $medical_center_id)
            ->where('user_id', $request->id)->first();

        if ($staff) {
            return redirect()->back()->withErrors('El usuario no pertenece a su centro médico');
        }

        $user = MedicalCenterStaff::with(['staff', 'medicalCenter'])->where('user_id', $id)->first();
        $roles = Role::select('id', 'display_name')->where('level', '>', auth()->user()->role->level)->get();

        return view('app.hospital.staff.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(StaffRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'El campo id es obligatorio.',
            'user_id.exists' => 'El usuario no existe en la base de datos.',
        ]);

        $request->validate([
            'user_id' => 'required|exists:medical_center_staff,user_id',
        ], [
            'user_id.required' => 'El campo id es obligatorio.',
            'user_id.exists' => 'El usuario no existe.',
        ]);

        $medical_center_id = session('medical_center_id');

        if (!$medical_center_id) {
            return redirect()->back()->withErrors('No cuenta con un centro médico asignado');
        }

        $staff = MedicalCenterStaff::with(['staff', 'medicalCenter'])
            ->where('medical_center_id', '!=', $medical_center_id)
            ->where('user_id', $request->user_id)->first();

        if ($staff) {
            return redirect()->back()->withErrors('El usuario no pertenece a su centro médico');
        }

        $user = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->route('hospital.staff.index')->withSuccess('El usuario ha sido actualizado correctamente.');
    }
}
