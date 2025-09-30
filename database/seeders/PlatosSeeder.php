<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatosSeeder extends Seeder
{
    public function run()
    {
        $platos = [
            [
                'nombre' => 'Majadito',
                'descripcion' => 'Arroz frito con carne seca, huevo y plátano.',
                'precio' => 35.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Locro',
                'descripcion' => 'Sopa espesa de maíz, papa y carne de res.',
                'precio' => 30.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pique macho',
                'descripcion' => 'Carne, salchichas, papas fritas, huevo y salsa picante.',
                'precio' => 40.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sopa de maní',
                'descripcion' => 'Sopa cremosa hecha con maní molido y verduras.',
                'precio' => 28.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ensalada rusa',
                'descripcion' => 'Puré de papa, zanahoria y mayonesa.',
                'precio' => 20.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Charque de llama',
                'descripcion' => 'Carne seca de llama desmenuzada y guisada.',
                'precio' => 38.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mocochinchi',
                'descripcion' => 'Bebida tradicional hecha con durazno seco y canela.',
                'precio' => 10.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cuñapé',
                'descripcion' => 'Pan de queso típico de Santa Cruz.',
                'precio' => 15.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Yuca frita',
                'descripcion' => 'Yuca cortada y frita como acompañamiento.',
                'precio' => 18.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Silpancho',
                'descripcion' => 'Carne empanizada con arroz, papas y huevo frito.',
                'precio' => 42.00,
                'disponible' => true,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('platos')->insert($platos);
    }
}
