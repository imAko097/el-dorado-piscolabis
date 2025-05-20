<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class EntranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 7; // ID Entrantes

        // Entrantes
        $entrantes = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pan',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '0.40',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pan de ajo',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pan con ali-oli',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.60',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pan con queso, tomate y orégano',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'nuggets y alitas 18 Uds.',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '3.80',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $entrantes = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $entrantes);

        // Insertar en la tabla
        foreach ($entrantes as $entrante) {
            Producto::updateOrInsert(
                ['nombre' => $entrante['nombre']], // clave
                $entrante // valores
            );
        }
    }
}
