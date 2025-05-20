<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tipos de productos
        $tipos = [
            'bocadillos',
            'sandwiches',
            'croissants',
            'kebab',
            'hamburguesas',
            'perritos',
            'entrantes',
            'papas',
            'ensaladas',
            'platos combinados',
            'pizzas',
            'bebidas'
        ];

        // Poblar base de datos
        foreach ($tipos as $tipo) {
            DB::table('producto_tipos')->updateOrInsert([
                'tipo' => $tipo,
            ]);
        }
    }
}
