<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class CroissantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 3; // ID Croissants

        $croissants = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'mixto',
                'ingredientes' => 'jamón y queso',
                'imagen' => '',
                'precio' => '2.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vegetal',
                'ingredientes' => 'lechuga, tomate, huevo, zanahoria y mayonesa',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'gambas',
                'ingredientes' => 'lechuga, tomate, gambas, cangrejo y mayonesa',
                'imagen' => '',
                'precio' => '3.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial dorado',
                'ingredientes' => 'lechuga, tomate, bacon, huevo, zanahoria, mayonesa, jamón y queso + papas',
                'imagen' => '',
                'precio' => '4.00',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $croissants = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $croissants);

        // Insertar en la tabla
        foreach ($croissants as $croissant) {
            Producto::updateOrInsert(
                [
                    'nombre' => $croissant['nombre'],
                    'id_producto_tipos' => $croissant['id_producto_tipos'],
                ], // clave combinada
                $croissant // valores
            );
        }
    }
}
