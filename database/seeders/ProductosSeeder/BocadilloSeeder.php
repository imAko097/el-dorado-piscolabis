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
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pechuga',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vuelta',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tortilla papas',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescado',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calamares',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'carne mechada + queso',
                'ingredientes' => '',
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
