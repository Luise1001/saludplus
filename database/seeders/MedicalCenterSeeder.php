<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administration\MedicalCenter;

class MedicalCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalCenter::create([
            'name' => 'Hospital Dr. Rafael Medina Jiménez',
            'short_name' => 'Hospital Periférico de Pariata',
            'document' => 'g1',
            'state_id' => 1,
            'municipality_id' => 1,
            'parish_id' => 1,
            'active' => true
        ]);
    }
}
