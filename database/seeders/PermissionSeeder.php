<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'menu_id' => 1,
                'route' => 'menu.index',
                'name' => 'menu.manage',
                'display_name' => 'Menu',
                'description' => 'Gestionar los menús del sistema',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 1,
                'route' => 'role.index',
                'name' => 'role.manage',
                'display_name' => 'Roles',
                'description' => 'Gestionar los roles del sistema',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 1,
                'route' => 'permission.index',
                'name' => 'permission.manage',
                'display_name' => 'Permisos',
                'description' => 'Gestionar los permisos de los usuarios',
                'active' => true,
                'level' => 1,
            ],
            [
                'menu_id' => 1,
                'route' => 'medical.center.index',
                'name' => 'medical.center.manage',
                'display_name' => 'Centros Médicos',
                'description' => 'Gestionar los centros médicos del sistema',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 1,
                'route' => 'medical.area.index',
                'name' => 'medical.area.manage',
                'display_name' => 'Áreas de atención',
                'description' => 'Gestionar las áreas de atención del sistema',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 1,
                'route' => 'doctor.index',
                'name' => 'doctor.manage',
                'display_name' => 'Especialistas',
                'description' => 'Gestionar los especialistas del sistema',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 1,
                'route' => 'medical.schedule.index',
                'name' => 'medical.schedule.manage',
                'display_name' => 'Horarios',
                'description' => 'Gestionar los horarios de atención del hospital',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 1,
                'route' => 'center.reservation.index',
                'name' => 'center.reservation.manage',
                'display_name' => 'Citas',
                'description' => 'Gestionar las citas médicas del sistema',
                'active' => true,
                'level' => 2,
            ],
            [
                'menu_id' => 1,
                'route' => 'center.reservation.index',
                'name' => 'center.reservation.manage',
                'display_name' => 'Empleados',
                'description' => 'Gestionar los empleados del hospital',
                'active' => true,
                'level' => 3,
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
