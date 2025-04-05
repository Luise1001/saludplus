<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                "estado" => "La Guaira",
                "capital" => "La Guaira",
                "id_estado" => 21,
                "municipios" => [
                    [
                        "municipio" => "Vargas",
                        "capital" => "Vargas",
                        "parroquias" => [
                            "Caraballeda",
                            "Carayaca",
                            "Carlos Soublette",
                            "Caruao Chuspa",
                            "Catia La Mar",
                            "El Junko",
                            "La Guaira",
                            "Macuto",
                            "Maiquetía",
                            "Naiguatá",
                            "Urimare"
                        ]
                    ]
                ],
                "ciudades" => [
                    "Carayaca",
                    "Litoral"
                ]
            ],

        ];

        foreach ($data as $stateData) {

            $state = State::create([
                'name' => $stateData['estado'],
                'capital' => $stateData['capital']
            ]);

            foreach ($stateData['municipios'] as $municipalityData) {
                $municipality = Municipality::create([
                    'name' => $municipalityData['municipio'],
                    'capital' => $municipalityData['capital'],
                    'state_id' => $state->id,
                ]);

                foreach ($municipalityData['parroquias'] as $parishName) {
                    Parish::create([
                        'name' => $parishName,
                        'municipality_id' => $municipality->id,
                    ]);
                }
            }
        }
    }
}
