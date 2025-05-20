<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class BocadilloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 1; // ID Bocadillos

        // Bocadillos
        $bocadillos = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'lomo',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'lomo con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'lomo especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vuelta',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vuelta con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vuelta especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tortilla papas',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tortilla papas con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tortilla papas especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescado',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescado con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescado especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calamares',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calamares con queso',
                'ingredientes' => 'ali-oli y queso',
                'imagen' => '',
                'precio' => '2.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calamares especial',
                'ingredientes' => 'ali-oli, queso, lechuga, tomate, cebolla, huevo + papas',
                'imagen' => '',
                'precio' => '2.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'carne mechada + queso',
                'ingredientes' => 'ali-oli',
                'imagen' => '',
                'precio' => '2.60',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $bocadillos = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $bocadillos);

        // Insertar en la tabla
        foreach ($bocadillos as $bocadillo) {
            Producto::updateOrInsert(
                ['nombre' => $bocadillo['nombre']], // clave
                $bocadillo // valores
            );
        }
    }
}
