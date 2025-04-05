<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'developer',
            'display_name' => 'Desarrollador',
            'level' => 1,
            'color' => 'warning',
            'description' => 'Rol de administrador con todos los permisos',
            'active' => true
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'level' => 2,
            'color' => 'success',
            'description' => 'Rol de administrador con permisos de gestión',
            'active' => true
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'Usuario general',
            'level' => 10,
            'color' => 'primary',
            'description' => 'Rol de usuario con permisos limitados',
            'active' => true
        ]);


    }
}
