<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class HamburguesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo =  5; // ID Hamburguesas

        // Hamburguesas
        $hamburguesas = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'normal',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup) y cebolla',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'con queso',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup), cebolla y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial',
                'ingredientes' => 'lechuga, tomate natural, cebolla, jamón, queso y 3 salsas (ali-oli, mostaza y ketchup)',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'royal',
                'ingredientes' => 'pollo empanado, lechuga, tomate natural, cebolla y barbacoa',
                'imagen' => '',
                'precio' => '3.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial dorado',
                'ingredientes' => 'lechuga, tomate natural, cebolla, jamón, queso, bacon, huevo, 3 salsas (ali-oli, mostaza y ketchup) + papas',
                'imagen' => '',
                'precio' => '4.30',
            ],                
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $hamburguesas = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $hamburguesas);

        // Insertar en la tabla
        foreach ($hamburguesas as $hamburguesa) {
            Producto::updateOrInsert(
                [
                    'nombre' => $hamburguesa['nombre'],
                    'id_producto_tipos' => $hamburguesa['id_producto_tipos'],
                ], // clave combinada
                $hamburguesa // valores
            );
        }
    }
}
