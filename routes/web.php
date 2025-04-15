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
use App\Http\Controllers\Web\App\Administration\MedicalCenterStaffController;
use App\Http\Controllers\Web\App\Hospital\HospitalDoctorController;
use App\Http\Controllers\Web\App\Hospital\HospitalScheduleController;
use App\Http\Controllers\Web\App\Hospital\HospitalStaffController;

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
    Route::group(['middleware' => ['check.user.permission:menu.manage']], function () {
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/crear', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/menu/crear', [MenuController::class, 'store'])->name('menu.store');
        Route::put('/menu/editar', [MenuController::class, 'update'])->name('menu.update');
        Route::get('/menu/editar/id={id}', [MenuController::class, 'edit'])->name('menu.edit');
    });

    /**
     * Roles 
     */
    Route::group(['middleware' => ['check.user.permission:role.manage']], function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('/roles/crear', [RoleController::class, 'create'])->name('role.create');
        Route::post('/roles/crear', [RoleController::class, 'store'])->name('role.store');
        Route::put('/roles/editar', [RoleController::class, 'update'])->name('role.update');
        Route::get('/roles/editar/id={id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::get('/roles/permisos/rol/id={id}', [RoleController::class, 'detail'])->name('role.detail');
        Route::put('/roles/role/asignar-permisos', [RoleController::class, 'PermissionAssign'])->name('role.permission.sync');
    });

    /**
     * Permissions
     */
    Route::group(['middleware' => ['check.user.permission:permission.manage']], function () {
        Route::get('/permisos', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/permisos/crear', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/permisos/crear', [PermissionController::class, 'store'])->name('permission.store');
        Route::put('/permisos/editar', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/permisos/editar/id={id}', [PermissionController::class, 'edit'])->name('permission.edit');
    });


    /**
     * Medical Center
     */
    Route::group(['middleware' => ['check.user.permission:medical.center.manage']], function () {
        Route::get('/centros-medicos', [MedicalCenterController::class, 'index'])->name('medical.center.index');
        Route::get('/centros-medicos/crear', [MedicalCenterController::class, 'create'])->name('medical.center.create');
        Route::post('/centros-medicos/crear', [MedicalCenterController::class, 'store'])->name('medical.center.store');
        Route::put('/centros-medicos/editar', [MedicalCenterController::class, 'update'])->name('medical.center.update');
        Route::get('/centros-medicos/editar/id={id}', [MedicalCenterController::class, 'edit'])->name('medical.center.edit');
    });

    /**
     * Medical Center Settings
     */
    Route::group(['middleware' => ['check.user.permission:hospital.setting']], function () {
        Route::get('/centros-medicos/configuracion', [MedicalCenterSettingController::class, 'index'])->name('medical.center.setting.index');
        Route::put('/centros-medicos/configuracion/areas', [MedicalCenterSettingController::class, 'areas'])->name('medical.center.setting.areas');
        Route::put('/centros-medicos/configuracion/especialistas', [MedicalCenterSettingController::class, 'doctors'])->name('medical.center.setting.doctors');
    });

    /**
     * Medical Áreas
     */
    Route::group(['middleware' => ['check.user.permission:medical.area.manage']], function () {
        Route::get('/areas-de-atencion', [MedicalAreaController::class, 'index'])->name('medical.area.index');
        Route::get('/areas-de-atencion/crear', [MedicalAreaController::class, 'create'])->name('medical.area.create');
        Route::post('/areas-de-atencion/crear', [MedicalAreaController::class, 'store'])->name('medical.area.store');
        Route::put('/areas-de-atencion/editar', [MedicalAreaController::class, 'update'])->name('medical.area.update');
        Route::get('/areas-de-atencion/editar/id={id}', [MedicalAreaController::class, 'edit'])->name('medical.area.edit');
    });

    /**
     * Doctors
     */
    Route::group(['middleware' => ['check.user.permission:doctor.manage']], function () {
        Route::get('/especialitas', [DoctorController::class, 'index'])->name('doctor.index');
        Route::get('/especialitas/crear', [DoctorController::class, 'create'])->name('doctor.create');
        Route::post('/especialitas/crear', [DoctorController::class, 'store'])->name('doctor.store');
        Route::put('/especialitas/editar', [DoctorController::class, 'update'])->name('doctor.update');
        Route::get('/especialitas/editar/id={id}', [DoctorController::class, 'edit'])->name('doctor.edit');
    });


    /**
     * Medical Schedule
     */
    Route::group(['middleware' => ['check.user.permission:medical.schedule.manage']], function () {
        Route::get('/horarios', [MedicalScheduleController::class, 'index'])->name('medical.schedule.index');
        Route::get('/horarios/crear', [MedicalScheduleController::class, 'create'])->name('medical.schedule.create');
        Route::post('/horarios/crear', [MedicalScheduleController::class, 'store'])->name('medical.schedule.store');
        Route::put('/horarios/editar', [MedicalScheduleController::class, 'update'])->name('medical.schedule.update');
        Route::get('/horarios/editar/id={id}', [MedicalScheduleController::class, 'edit'])->name('medical.schedule.edit');
    });

    /**
     * Staff
     */
    Route::group(['middleware' => ['check.user.permission:staff.manage']], function () {
        Route::get('/personal', [MedicalCenterStaffController::class, 'index'])->name('staff.index');
        Route::get('/personal/crear', [MedicalCenterStaffController::class, 'create'])->name('staff.create');
        Route::post('/personal/crear', [MedicalCenterStaffController::class, 'store'])->name('staff.store');
        Route::put('/personal/editar', [MedicalCenterStaffController::class, 'update'])->name('staff.update');
        Route::get('/personal/editar/id={id}', [MedicalCenterStaffController::class, 'edit'])->name('staff.edit');
        Route::get('/personal/editar/id={id}/asignar-centro', [MedicalCenterStaffController::class, 'assign'])->name('staff.assign');
    });

    /**
     * Center Reservation
     */
    Route::group(['middleware' => ['check.user.permission:reservation.manage']], function () {
        Route::get('/centro-medico/citas', [CenterReservationController::class, 'index'])->name('center.reservation.index');
        Route::get('/centro-medico/citas/confirmar/id={id}', [CenterReservationController::class, 'confirm'])->name('center.reservation.confirm');
        Route::get('/centro-medico/citas/cancelar/id={id}', [CenterReservationController::class, 'cancel'])->name('center.reservation.cancel');
    });

    /**
     * Users
     */
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');




    /*******************************************************************************************************************************************
     * Hospital routes
     *******************************************************************************************************************************************/
    Route::middleware(['check.hospital'])->group(function () {
        /**
         * Hospital doctors
         */
        Route::group(['middleware' => ['check.user.permission:hospital.doctor.manage']], function () {
            Route::get('/centro-medico/especialistas', [HospitalDoctorController::class, 'index'])->name('hospital.doctor.index');
            Route::get('/centro-medico/especialistas/crear', [HospitalDoctorController::class, 'create'])->name('hospital.doctor.create');
            Route::post('/centro-medico/especialistas/crear', [HospitalDoctorController::class, 'store'])->name('hospital.doctor.store');
            Route::put('/centro-medico/especialistas/editar', [HospitalDoctorController::class, 'update'])->name('hospital.doctor.update');
            Route::get('/centro-medico/especialistas/editar/id={id}', [HospitalDoctorController::class, 'edit'])->name('hospital.doctor.edit');
        });

        /**
         * Hospital schedule
         */
        Route::group(['middleware' => ['check.user.permission:hospital.schedule.manage']], function () {
            Route::get('/centro-medico/horarios', [HospitalScheduleController::class, 'index'])->name('hospital.schedule.index');
            Route::get('/centro-medico/horarios/crear', [HospitalScheduleController::class, 'create'])->name('hospital.schedule.create');
            Route::post('/centro-medico/horarios/crear', [HospitalScheduleController::class, 'store'])->name('hospital.schedule.store');
            Route::put('/centro-medico/horarios/editar', [HospitalScheduleController::class, 'update'])->name('hospital.schedule.update');
            Route::get('/centro-medico/horarios/editar/id={id}', [HospitalScheduleController::class, 'edit'])->name('hospital.schedule.edit');
        });

        /**
         *  Hospital Staff
         */
        Route::group(['middleware' => ['check.user.permission:hospital.staff.manage']], function () {
            Route::get('/centro-medico/personal', [HospitalStaffController::class, 'index'])->name('hospital.staff.index');
            Route::get('/centro-medico/personal/crear', [HospitalStaffController::class, 'create'])->name('hospital.staff.create');
            Route::post('/centro-medico/personal/crear', [HospitalStaffController::class, 'store'])->name('hospital.staff.store');
            Route::put('/centro-medico/personal/editar', [HospitalStaffController::class, 'update'])->name('hospital.staff.update');
            Route::get('/centro-medico/personal/editar/id={id}', [HospitalStaffController::class, 'edit'])->name('hospital.staff.edit');
            Route::get('/centro-medico/personal/editar/id={id}/asignar-centro', [HospitalStaffController::class, 'assign'])->name('hospital.staff.assign');
        });
    });
});
