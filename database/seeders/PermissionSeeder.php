<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'menu_id' => 3,
                'route' => 'menu.index',
                'name' => 'menu.manage',
                'display_name' => 'Menu',
                'description' => 'Gestionar los menús del sistema',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 3,
                'route' => 'role.index',
                'name' => 'role.manage',
                'display_name' => 'Roles',
                'description' => 'Gestionar los roles del sistema',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 3,
                'route' => 'permission.index',
                'name' => 'permission.manage',
                'display_name' => 'Permisos',
                'description' => 'Gestionar los permisos de los usuarios',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 3,
                'route' => 'medical.center.index',
                'name' => 'medical.center.manage',
                'display_name' => 'Centros Médicos',
                'description' => 'Gestionar los centros médicos del sistema',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 3,
                'route' => 'medical.area.index',
                'name' => 'medical.area.manage',
                'display_name' => 'Áreas de atención',
                'description' => 'Gestionar las áreas de atención del sistema',
                'active' => true,
                'level' => 3,
            ],
            [
                'menu_id' => 3,
                'route' => 'doctor.index',
                'name' => 'doctor.manage',
                'display_name' => 'Especialistas',
                'description' => 'Gestionar los especialistas del sistema',
                'active' => true,
                'level' => 3,
            ],
            [
                'menu_id' => 3,
                'route' => 'medical.schedule.index',
                'name' => 'medical.schedule.manage',
                'display_name' => 'Horarios',
                'description' => 'Gestionar los horarios de los hospitales',
                'active' => true,
                'level' => 3,
            ],
            [
                'menu_id' => 3,
                'route' => 'staff.index',
                'name' => 'staff.manage',
                'display_name' => 'Usuarios',
                'description' => 'Gestionar los usuarios del hospital',
                'active' => true,
                'level' => 3,
            ],
            [
                'menu_id' => 3,
                'route' => 'hospital.reservation.index',
                'name' => 'hospital.reservation.manage',
                'display_name' => 'Control de citas',
                'description' => 'Gestionar las citas médicas del hospital',
                'active' => true,
                'level' => 8,
            ],
            [
                'menu_id' => 5,
                'route' => 'medical.center.setting.index',
                'name' => 'medical.center.setting',
                'display_name' => 'Centro médico',
                'description' => 'Configurar el centro médico al que pertenece el usuario',
                'active' => true,
                'level' => 4,
            ],
            [
                'menu_id' => 3,
                'route' => 'hospital.doctor.index',
                'name' => 'hospital.doctor.manage',
                'display_name' => 'Especialistas',
                'description' => 'Gestionar los especialistas del hospital',
                'active' => true,
                'level' => 4,
            ],
            [
                'menu_id' => 3,
                'route' => 'hospital.schedule.index',
                'name' => 'hospital.schedule.manage',
                'display_name' => 'Horarios',
                'description' => 'Gestionar los horarios del hospital',
                'active' => true,
                'level' => 4,
            ],
            [
                'menu_id' => 3,
                'route' => 'hospital.staff.index',
                'name' => 'hospital.staff.manage',
                'display_name' => 'Usuarios',
                'description' => 'Gestionar los usuarios del personal del hospital',
                'active' => true,
                'level' => 4,
            ],
            [
                'menu_id' => 2,
                'route' => 'patient.reservation.history',
                'name' => 'patient.reservation.history',
                'display_name' => 'Historial de citas',
                'description' => 'Consultar el historial de citas médicas del paciente',
                'active' => true,
                'level' => 10,
            ],
            [
                'menu_id' => 3,
                'route' => 'patient.reservation.reserve',
                'name' => 'patient.reservation.reserve',
                'display_name' => 'Reservar cita',
                'description' => 'Reservar una cita médica',
                'active' => true,
                'level' => 10,
            ],
        ];

        $permissionIds = [];

        foreach ($permissions as $permissionData) {
            $permission = Permission::create($permissionData);
            $permissionIds[] = $permission->id;
        }

        $role = Role::find(1);
        if ($role) {
            $role->permissions()->sync($permissionIds);
        }
    }
}
