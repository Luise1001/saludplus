<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\RoleSeeder::class);
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->call(\Database\Seeders\MenuSeeder::class);
        $this->call(\Database\Seeders\PermissionSeeder::class);
        $this->call(\Database\Seeders\LocationSeeder::class);
        $this->call(\Database\Seeders\MedicalAreaSeeder::class);
        $this->call(\Database\Seeders\MedicalCenterSeeder::class);
    }
}
