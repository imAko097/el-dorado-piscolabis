<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class PerritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 6; // ID Perritos

        // Perritos
        $perritos = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'normal',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup) y cebolla',
                'imagen' => '',
                'precio' => '1.70',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup), cebolla y queso',
                'imagen' => '',
                'precio' => '1.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial dorado',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup), cebolla, queso, jamón + papas',
                'imagen' => '',
                'precio' => '3.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'caliente crujiente',
                'ingredientes' => 'Salsa picante, cebolla crujiente y col',
                'imagen' => '',
                'precio' => '2.00',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $perritos = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $perritos);

        // Insertar en la tabla
        foreach ($perritos as $perrito) {
            Producto::updateOrInsert(
                [
                    'nombre' => $perrito['nombre'],
                    'id_producto_tipos' => $perrito['id_producto_tipos'],
                ], // clave combinada
                $perrito // valores
            );
        }
    }
}
