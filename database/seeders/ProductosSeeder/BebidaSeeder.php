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
                'nombre' => 'coca cola lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'fanta lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => '7up lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'clipper de fresa lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'clipper de naranja lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'coca cola botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'fanta botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => '7up botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'clipper de fresa botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'clipper de naranja botella 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tropical lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.75',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tropical limón lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.75',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'dorada lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.75',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'estrella galicia lata 33cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.75',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tropical 1L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'dorada 1L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'nestea mango-piña',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'nestea limón',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.30',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'red bull 473 ml',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.95',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'monster verde 500ml',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '2.35',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'acuarius limón 50cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.52',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'agua 50cl',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '0.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'agua 1.5L',
                'ingredientes' => '',
                'imagen' => '',
                'precio' => '1.00',
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
