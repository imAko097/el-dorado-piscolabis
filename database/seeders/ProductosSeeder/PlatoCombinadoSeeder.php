<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class PlatoCombinadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 10; // ID Plato Combinado

        // Plato Combinado
        $platoCombinado = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calamares',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '8.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescado',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '6.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'croquetas',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '6.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vuelta a la casera',
                'ingredientes' => 'papas o arroz',
                'imagen' => '',
                'precio' => '7.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'albóndigas',
                'ingredientes' => 'papas o arroz',
                'imagen' => '',
                'precio' => '6.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'nuggets',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '5.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'lomo',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '6.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'ropa vieja',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '5.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga a la plancha',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '6.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga empanada',
                'ingredientes' => 'papas, ensalada y ali-oli',
                'imagen' => '',
                'precio' => '6.80',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $platoCombinado = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $platoCombinado);

        // Insertar en la tabla
        foreach ($platoCombinado as $plato) {
            Producto::updateOrInsert(
                [
                    'nombre' => $plato['nombre'],
                    'id_producto_tipos' => $plato['id_producto_tipos'],
                ], // clave combinada
                $plato // valores
            );
        }
    }
}
