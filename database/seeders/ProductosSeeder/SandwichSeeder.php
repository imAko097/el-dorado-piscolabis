<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class SandwichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 2; // ID Sandwiches

        $sandwiches = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'mixto',
                'ingredientes' => 'jamón y queso',
                'imagen' => '',
                'precio' => '1.60',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vegetal',
                'ingredientes' => 'lechuga, tomate, huevo, zanahoria y mayonesa',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'gambas',
                'ingredientes' => 'lechuga, tomate, gambas, cangrejo y mayonesa',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pollo odisea',
                'ingredientes' => 'pollo, vegetal, jamón y queso + papas',
                'imagen' => '',
                'precio' => '3.60',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial dorado',
                'ingredientes' => 'lechuga, tomate, bacon, huevo, zanahoria, mayonesa + jamón y queso + papas',
                'imagen' => '',
                'precio' => '3.60',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $sandwiches = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $sandwiches);

        // Insertar en la tabla
        foreach ($sandwiches as $sandwich) {
            Producto::updateOrInsert(
                ['nombre' => $sandwich['nombre']], // clave
                $sandwich // valores
            );
        }
    }
}
