<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Rol::insert([
            ['nombre' => 'Cliente', 'descripcion' => 'Acceso al menu'],
            ['nombre' => 'Administrador', 'descripcion' => 'Acceso completo al sistema'],
            ['nombre' => 'Cocinero', 'descripcion' => 'Preparación de alimentos'],
            ['nombre' => 'Cajero', 'descripcion' => 'Gestión de caja y pagos'],
            ['nombre' => 'Mesero', 'descripcion' => 'Atención al cliente en mesas'],
        ]);
    }
}
