<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'sistema',
            'email' => 'sistema@saludplus.com',
            'password' => bcrypt('501878'),
            'role_id' => 1,
        ]);
    }
}
