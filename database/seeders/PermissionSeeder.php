<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\RolePermission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::create([
            'menu_id' => 1,
            'route' => 'role.index',
            'name' => 'role.manage',
            'display_name' => 'Roles',
            'description' => 'Gestionar los roles del sistema',
            'active' => true,
            'level' => 1,
        ]);

        RolePermission::create([
            'role_id' => 1,
            'permission_id' => $permission->id
        ]);

        $permission = Permission::create([
            'menu_id' => 1,
            'route' => 'permission.index',
            'name' => 'permission.manage',
            'display_name' => 'Permisos',
            'description' => 'Gestionar los permisos de los usuarios',
            'active' => true,
            'level' => 1,
        ]);

        RolePermission::create([
            'role_id' => 1,
            'permission_id' => $permission->id
        ]);

        $permission = Permission::create([
            'menu_id' => 1,
            'route' => 'medical.center.index',
            'name' => 'medical.center.manage',
            'display_name' => 'Centros Médicos',
            'description' => 'Gestionar los centros médicos del sistema',
            'active' => true,
            'level' => 1,
        ]);

        RolePermission::create([
            'role_id' => 1,
            'permission_id' => $permission->id
        ]);

        $permission = Permission::create([
            'menu_id' => 1,
            'route' => 'medical.area.index',
            'name' => 'medical.area.manage',
            'display_name' => 'Áreas de atención',
            'description' => 'Gestionar las áreas de atención del sistema',
            'active' => true,
            'level' => 1,
        ]);

        RolePermission::create([
            'role_id' => 1,
            'permission_id' => $permission->id
        ]);

        $permission = Permission::create([
            'menu_id' => 1,
            'route' => 'docttor.index',
            'name' => 'docttor.manage',
            'display_name' => 'Especialistas',
            'description' => 'Gestionar los especialistas del sistema',
            'active' => true,
            'level' => 1,
        ]);

        RolePermission::create([
            'role_id' => 1,
            'permission_id' => $permission->id
        ]);
    }
}
