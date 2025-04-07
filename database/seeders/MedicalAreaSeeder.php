<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administration\MedicalArea;

class MedicalAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            'Medicina General',
            'Medicina Interna',
            'Pediatría',
            'Ginecología y Obstetricia',
            'Obstetricia',
            'Traumatología y Ortopedia',
            'Cirugía General',
            'Cardiología',
            'Neumonología',
            'Neurología',
            'Endocrinología',
            'Dermatología',
            'Psiquiatría',
            'Psicología',
            'Oftalmología',
            'Otorrinolaringología',
            'Urología',
            'Gastroenterología',
            'Nefrología',
            'Oncología',
            'Reumatología',
            'Alergología',
            'Geriatría',
            'Infectología',
            'Hematología',
            'Radiología e Imagenología',
            'Anestesiología',
            'Odontología General',
            'Odontopediatría',
            'Cirugía Maxilofacial',
            'Laboratorio Clínico',
            'Banco de Sangre',
            'Fisioterapia y Rehabilitación',
            'Medicina Física y Rehabilitación',
            'Medicina Ocupacional',
            'Medicina del Deporte',
            'Nutrición y Dietética',
            'Emergencias',
            'Unidad de Cuidados Intensivos (UCI)',
            'Unidad de Cuidados Neonatales (UCIN)',
            'Neonatología',
            'Hospitalización',
            'Farmacia Hospitalaria',
            'Terapia Respiratoria',
            'Inmunología',
            'Terapia del Lenguaje',
            'Terapia Ocupacional',
            'Salud Pública',
            'Planificación Familiar',
            'Atención Prenatal y Postnatal',
        ];

        foreach ($areas as $area) {
            MedicalArea::create([
                'name' => $area,
                'description' => 'Área de atención especializada en ' . strtolower($area),
                'active' => false,
            ]);
        }
    }
}
