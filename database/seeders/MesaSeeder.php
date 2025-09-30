<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mesa;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = ['libre', 'ocupada', 'reservada'];

        for ($i = 1; $i <= 10; $i++) {
            Mesa::create([
                'numero' => 'MESA-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'estado' => $estados[array_rand($estados)],
            ]);
        }
    }
}
