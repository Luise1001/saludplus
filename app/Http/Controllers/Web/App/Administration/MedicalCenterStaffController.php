<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Administration\MedicalCenterStaffRequest as StaffRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Administration\MedicalCenterStaff;
use App\Models\Administration\MedicalCenter;
use App\Models\Role;
use App\Models\User;

class MedicalCenterStaffController extends Controller
{
    public function index()
    {
        $users = MedicalCenterStaff::with(['staff', 'medicalCenter'])->get();

        return view('app.administration.medical-center-staff.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $centers = MedicalCenter::select('id', 'short_name')->get();
        $roles = Role::select('id', 'display_name')->where('level', '>', auth()->user()->role->level)->get();

        return view('app.administration.medical-center-staff.create', [
            'centers' =>  $centers,
            'roles' => $roles,
        ]);
    }

    public function store(StaffRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        MedicalCenterStaff::create([
            'user_id' => $user->id,
            'medical_center_id' => $request->medical_center_id,
        ]);

        return redirect()->route('staff.index')->withSuccess('El usuario ha sido creado correctamente.');
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

        $user = MedicalCenterStaff::with(['staff', 'medicalCenter'])->where('user_id', $id)->first();
        $centers = MedicalCenter::select('id', 'short_name')->get();
        $roles = Role::select('id', 'display_name')->where('level', '>', auth()->user()->role->level)->get();

        return view('app.administration.medical-center-staff.edit', [
            'user' => $user,
            'centers' =>  $centers,
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

        $user = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        $medicalCenterStaff = MedicalCenterStaff::where('user_id', $request->user_id)->first();
        $medicalCenterStaff->update([
            'medical_center_id' => $request->medical_center_id,
        ]);

        return redirect()->route('staff.index')->withSuccess('El usuario ha sido actualizado correctamente.');
    }
}
