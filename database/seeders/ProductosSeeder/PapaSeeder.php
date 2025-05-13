<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class PapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 8; // ID Papas

        // Papas
        $papas = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'cono',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'plato',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.10',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'plato deluxe',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'papas especial',
                'ingredientes' => '3 salsas (ali-oli, mostaza y ketchup), cebolla y queso',
                'imagen' => '',
                'precio' => '3.30',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $papas = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $papas);

        // Insertar en la tabla
        foreach ($papas as $papa) {
            Producto::updateOrInsert(
                ['nombre' => $papa['nombre']], // clave
                $papa // valores
            );
        }
    }
}
