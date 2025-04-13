<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\App\MenuController;
use App\Http\Controllers\Web\App\MainController;
use App\Http\Controllers\Web\App\RoleController;
use App\Http\Controllers\Web\App\PermissionController;
use App\Http\Controllers\Web\App\Auth\AuthController;
use App\Http\Controllers\Web\App\Patient\PatientController;
use App\Http\Controllers\Web\App\Patient\ReservationController;
use App\Http\Controllers\Web\App\ProfileController;
use App\Http\Controllers\Web\App\Administration\MedicalCenterController;
use App\Http\Controllers\Web\App\Administration\MedicalCenterSettingController;
use App\Http\Controllers\Web\App\Administration\MedicalAreaController;
use App\Http\Controllers\Web\App\Administration\DoctorController;
use App\Http\Controllers\Web\App\Administration\MedicalScheduleController;
use App\Http\Controllers\Web\App\Administration\CenterReservationController;

Route::middleware(['guest'])->group(function () {
    Route::post('/acceder', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/registar', [AuthController::class, 'register'])->name('auth.register');
});

Route::get('/', [MainController::class, 'index'])->name('app.index');

Route::middleware(['permissions'])->group(function () {
    Route::get('/registro-de-pacientes', [PatientController::class, 'index'])->name('patient.index');
    Route::post('/registro-de-pacientes', [PatientController::class, 'register'])->name('patient.register');

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
        return view('dashboard');
    })->name('dashboard');

    /**
     * Menús
     */
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/crear', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/crear', [MenuController::class, 'store'])->name('menu.store');
    Route::put('/menu/editar', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/menu/editar/id={id}', [MenuController::class, 'edit'])->name('menu.edit');


     
    /**
     * Roles 
     */
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/crear', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles/crear', [RoleController::class, 'store'])->name('role.store');
    Route::put('/roles/editar', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roles/editar/id={id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::get('/roles/permisos/rol/id={id}', [RoleController::class, 'detail'])->name('role.detail');
    Route::put('/roles/role/asignar-permisos', [RoleController::class, 'PermissionAssign'])->name('role.permission.sync');

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
     * Medical Center Settings
     */
    Route::get('/centros-medicos/configuracion/id={id}', [MedicalCenterSettingController::class, 'index'])->name('medical.center.setting.index');
    Route::put('/centros-medicos/configuracion/areas', [MedicalCenterSettingController::class, 'areas'])->name('medical.center.setting.areas');
    Route::put('/centros-medicos/configuracion/especialistas', [MedicalCenterSettingController::class, 'doctors'])->name('medical.center.setting.doctors');

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
     * Medical Schedule
     */
    Route::get('/horarios', [MedicalScheduleController::class, 'index'])->name('medical.schedule.index');
    Route::get('/horarios/crear', [MedicalScheduleController::class, 'create'])->name('medical.schedule.create');
    Route::post('/horarios/crear', [MedicalScheduleController::class, 'store'])->name('medical.schedule.store');
    Route::put('/horarios/editar', [MedicalScheduleController::class, 'update'])->name('medical.schedule.update');
    Route::get('/horarios/editar/id={id}', [MedicalScheduleController::class, 'edit'])->name('medical.schedule.edit');

    /**
     * Center Reservation
     */
    Route::get('/centro-medico/citas', [CenterReservationController::class, 'index'])->name('center.reservation.index');
    Route::get('/centro-medico/citas/confirmar/id={id}', [CenterReservationController::class, 'confirm'])->name('center.reservation.confirm');
    Route::get('/centro-medico/citas/cancelar/id={id}', [CenterReservationController::class, 'cancel'])->name('center.reservation.cancel');

    /**
     * Users
     */
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
});
