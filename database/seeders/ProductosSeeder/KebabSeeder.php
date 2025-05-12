<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class KebabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 4; // ID Kebab

        $kebabs = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'kebab',
                'ingredientes' => 'carne, col, salsa picante o yogurt, queso y tomate natural',
                'imagen' => '',
                'precio' => '2.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'fajita',
                'ingredientes' => 'pollo mechado, queso y barbacoa',
                'imagen' => '',
                'precio' => '2.60',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'burrito',
                'ingredientes' => 'carne boloñesa, queso y barbacoa',
                'imagen' => '',
                'precio' => '2.60',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $kebabs = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $kebabs);

        // Insertar en la tabla
        foreach ($kebabs as $kebab) {
            Producto::updateOrInsert(
                ['nombre' => $kebab['nombre']], // clave
                $kebab // valores
            );
        }
    }
}
