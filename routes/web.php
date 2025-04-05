<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\App\MainController;
use App\Http\Controllers\Web\App\RoleController;
use App\Http\Controllers\Web\App\PermissionController;
use App\Http\Controllers\Web\App\Auth\AuthController;
use App\Http\Controllers\Web\App\PatientController;
use App\Http\Controllers\Web\App\ReservationController;
use App\Http\Controllers\Web\App\ProfileController;
use App\Http\Controllers\Web\App\Administration\MedicalCenterController;
use App\Http\Controllers\Web\App\Administration\MedicalAreaController;
use App\Http\Controllers\Web\App\Administration\DoctorController;

Route::middleware(['guest'])->group(function () {
    Route::post('/acceder', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/registar', [AuthController::class, 'register'])->name('auth.register');
});

Route::get('/', [MainController::class, 'index'])->name('app.index');

Route::middleware(['permissions'])->group(function () {
    Route::get('/registro', [PatientController::class, 'index'])->name('patient.index');
    Route::post('/registro', [PatientController::class, 'register'])->name('patient.register');

    Route::get('/agendar-cita', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/agendar-cita', [ReservationController::class, 'reserve'])->name('reservation.reserve');
    Route::get('/comprobante', [ReservationController::class, 'sheet'])->name('reservation.sheet');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'permissions'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('reservation.index');
    })->name('dashboard');

    /**
     * Roles 
     */
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/crear', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles/crear', [RoleController::class, 'store'])->name('role.store');
    Route::put('/roles/editar', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roles/editar/id={id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::get('/roles/permisos/rol/id={id}', [RoleController::class, 'detail'])->name('role.detail');
    Route::put('/roles/role/asignar-permisos', [RoleController::class, 'permissionAsync'])->name('role.permission.async');

    /**
     * Permissions
     */
    Route::get('/permisos', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permisos/crear', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permisos/crear', [PermissionController::class, 'store'])->name('permission.store');
    Route::put('/permisos/editar', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permisos/editar/id={id}', [PermissionController::class, 'edit'])->name('permission.edit');

    /**
     * Medical Center
     */
    Route::get('/centros-medicos', [MedicalCenterController::class, 'index'])->name('medical.center.index');
    Route::get('/centros-medicos/crear', [MedicalCenterController::class, 'create'])->name('medical.center.create');
    Route::post('/centros-medicos/crear', [MedicalCenterController::class, 'store'])->name('medical.center.store');
    Route::put('/centros-medicos/editar', [MedicalCenterController::class, 'update'])->name('medical.center.update');
    Route::get('/centros-medicos/editar/id={id}', [MedicalCenterController::class, 'edit'])->name('medical.center.edit');

    /**
     * Medical Áreas
     */
    Route::get('/areas-de-atencion', [MedicalAreaController::class, 'index'])->name('medical.area.index');
    Route::get('/areas-de-atencion/crear', [MedicalAreaController::class, 'create'])->name('medical.area.create');
    Route::post('/areas-de-atencion/crear', [MedicalAreaController::class, 'store'])->name('medical.area.store');
    Route::put('/areas-de-atencion/editar', [MedicalAreaController::class, 'update'])->name('medical.area.update');
    Route::get('/areas-de-atencion/editar/id={id}', [MedicalAreaController::class, 'edit'])->name('medical.area.edit');

    /**
     * Doctors
     */
    Route::get('/especialitas', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('/especialitas/crear', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/especialitas/crear', [DoctorController::class, 'store'])->name('doctor.store');
    Route::put('/especialitas/editar', [DoctorController::class, 'update'])->name('doctor.update');
    Route::get('/especialitas/editar/id={id}', [DoctorController::class, 'edit'])->name('doctor.edit');

    /**
     * Users
     */
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
});
