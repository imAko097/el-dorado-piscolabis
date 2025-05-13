<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Producto;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 11; // ID Pizzas

        // Pizzas
        $pizzas = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'margarita',
                'ingredientes' => 'tomate y queso',
                'imagen' => '',
                'precio' => '5.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'caprichosa',
                'ingredientes' => 'tomate, queso, champiñones y jamón',
                'imagen' => '',
                'precio' => '7.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'ópera',
                'ingredientes' => 'tomate, queso jamón y atún',
                'imagen' => '',
                'precio' => '7.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'salami',
                'ingredientes' => 'tomate, queso, salami y pimiento',
                'imagen' => '',
                'precio' => '7.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tropical',
                'ingredientes' => 'tomate, queso, atún, plátano y piña',
                'imagen' => '',
                'precio' => '7.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'boem',
                'ingredientes' => 'tomate, queso, atún, gambas y jamón',
                'imagen' => '',
                'precio' => '7.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'romana',
                'ingredientes' => 'tomate, queso, jamón, bacon y tomate natural',
                'imagen' => '',
                'precio' => '7.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => '4 estaciones',
                'ingredientes' => 'tomate, queso, jamón, gambas, cebolla y aceitunas',
                'imagen' => '',
                'precio' => '8.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'giovanni',
                'ingredientes' => 'queso, barbacoa, carne boloñesa, cebolla y bacon',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'alaia',
                'ingredientes' => 'atún, aceituna verde, pimiento y cebolla',
                'imagen' => '',
                'precio' => '7.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'teseo',
                'ingredientes' => 'tomate, queso, solomillo, pimientos y alcaparras',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'texenery',
                'ingredientes' => 'tomate, queso, anchoas, mejillones y gambas',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'mica',
                'ingredientes' => 'pollo, cebolla, pimiento y barbacoa',
                'imagen' => '',
                'precio' => '7.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'vegetal',
                'ingredientes' => 'tomate, queso, cebolla, tomate natural, champiñones, pimientos, aceitunas y millo',
                'imagen' => '',
                'precio' => '7.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'especial dorado',
                'ingredientes' => 'tomate, queso, jamón, champiñones, gambas, mejillones, cangrejo y huevo',
                'imagen' => '',
                'precio' => '8.00',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calzone marisco',
                'ingredientes' => 'tomate, queso, atún, gambas, mejillones y cangrejo',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'pescadora',
                'ingredientes' => 'pescado, tomate natural, cebolla y alcaparras',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'marinera',
                'ingredientes' => 'tomate, queso, atún, gambas, mejillones y cangrejo',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'delicias del mar',
                'ingredientes' => 'tomate, queso, calamares, gambas y cangrejo',
                'imagen' => '',
                'precio' => '8.80',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'kebab',
                'ingredientes' => 'salchicha, carne kebab, barbacoa y queso',
                'imagen' => '',
                'precio' => '8.20',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'calzone boloñesa',
                'ingredientes' => 'queso y carne boloñesa',
                'imagen' => '',
                'precio' => '8.00',
            ]
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $pizzas = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $pizzas);

        // Insertar en la tabla
        foreach ($pizzas as $pizza) {
            Producto::updateOrInsert(
                [
                    'nombre' => $pizza['nombre'],
                    'id_producto_tipos' => $pizza['id_producto_tipos'],
                ], // clave combinada
                $pizza // valores
            );
        }
    }
}
