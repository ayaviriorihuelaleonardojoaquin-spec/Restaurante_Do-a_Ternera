<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // Buscar los roles que se crearon previamente
        $adminRol = Rol::where('nombre', 'Administrador')->first();
        $cocineroRol = Rol::where('nombre', 'Cocinero')->first();
        $cajeroRol = Rol::where('nombre', 'Cajero')->first();
        $meseroRol = Rol::where('nombre', 'Mesero')->first();

        // Administrador
        User::create([
            'name' => 'Admin',
            'last_name' => 'Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'rol_id' => $adminRol->id,
            'avatar' => null,
        ]);

        // Cocinero
        User::create([
            'name' => 'Carlos',
            'last_name' => 'Cocina',
            'email' => 'cocinero@example.com',
            'password' => Hash::make('cocinero123'),
            'rol_id' => $cocineroRol->id,
            'avatar' => null,
        ]);

        // Cajero
        User::create([
            'name' => 'Camila',
            'last_name' => 'Caja',
            'email' => 'cajero@example.com',
            'password' => Hash::make('cajero123'),
            'rol_id' => $cajeroRol->id,
            'avatar' => null,
        ]);

        // Mesero
        User::create([
            'name' => 'Mateo',
            'last_name' => 'Servicio',
            'email' => 'mesero@example.com',
            'password' => Hash::make('mesero123'),
            'rol_id' => $meseroRol->id,
            'avatar' => null,
        ]);
    }
}
