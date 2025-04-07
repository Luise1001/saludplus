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
            'description' => 'Dessarrollador del sistema',
            'active' => true
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'level' => 2,
            'color' => 'success',
            'description' => 'Administrador de hospitales',
            'active' => true
        ]);


        /**
         * all the next roles are for each hospital
         */

        Role::create([
            'name' => 'president',
            'display_name' => 'Presidente',
            'level' => 3,
            'color' => 'success',
            'description' => 'Director del hospital',
            'active' => true
        ]);

        Role::create([
            'name' => 'supervisor',
            'display_name' => 'Supervisor',
            'level' => 4,
            'color' => 'success',
            'description' => 'Supervisor del sistema',
            'active' => true
        ]);

        Role::create([
            'name' => 'assistant',
            'display_name' => 'Asistente administrativo',
            'level' => 5,
            'color' => 'success',
            'description' => 'Asistente administrativo del hospital',
            'active' => true
        ]);

        Role::create([
            'name' => 'doctor',
            'display_name' => 'Doctor',
            'level' => 6,
            'color' => 'success',
            'description' => 'Doctor del hospital',
            'active' => true
        ]);

        Role::create([
            'name' => 'nurse',
            'display_name' => 'Enfermero',
            'level' => 7,
            'color' => 'success',
            'description' => 'Enfermero del hospital',
            'active' => true
        ]);

        Role::create([
            'name' => 'receptionist',
            'display_name' => 'Recepcionista',
            'level' => 7,
            'color' => 'success',
            'description' => 'Recepcionista del hospital',
            'active' => true
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'Usuario general',
            'level' => 10,
            'color' => 'primary',
            'description' => 'Rol general para los usuarios del sistema, los pacientes.',
            'active' => true
        ]);

    }
}
