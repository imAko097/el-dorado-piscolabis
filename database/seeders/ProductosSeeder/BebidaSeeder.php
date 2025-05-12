<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class BebidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 12; // ID Bebidas

        // Bebidas
        $bebidas = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'refrescos lata',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'refrescos botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'cerveza lata',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'cerveza litrona',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'nestea',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'red bull',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'acuarius',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'agua 50cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '0.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'agua 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $bebidas = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $bebidas);

        // Insertar en la tabla
        foreach ($bebidas as $bebida) {
            Producto::updateOrInsert(
                ['nombre' => $bebida['nombre']], // clave
                $bebida // valores
            );
        }
    }
}
