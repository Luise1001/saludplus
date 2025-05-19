<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'ki-duotone ki-note-2',
            'icon_items' => 5,
        ]);

        Menu::create([
            'name' => 'Consultas',
            'icon' => 'ki-duotone ki-sort',
            'icon_items' => 5,
        ]);

        Menu::create([
            'name' => 'Gestionar',
            'icon' => 'ki-duotone ki-category',
            'icon_items' => 6,
        ]);

        Menu::create([
            'name' => 'Reportes',
            'icon' => 'ki-duotone ki-document',
            'icon_items' => 3,
        ]);

        Menu::create([
            'name' => 'Configuración',
            'icon' => 'ki-duotone ki-setting-2',
            'icon_items' => 6,
        ]);
    }
}
