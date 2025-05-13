<?php

namespace Database\Seeders\ProductosSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Producto;

class EnsaladaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = 9; // ID Ensaladas

        // Ensaladas
        $ensaladas = [
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'tifani',
                'ingredientes' => 'col, zanahoria, jamón, piña, pollo y salsa especial',
                'imagen' => '',
                'precio' => '5.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'macarrones',
                'ingredientes' => 'cangrejo, atún, huevo, pimiento rojo, mayonesa',
                'imagen' => '',
                'precio' => '5.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'mixta',
                'ingredientes' => 'lechuga, tomate, atún, zanahoria, cebolla, huevo, aceitunas y millo',
                'imagen' => '',
                'precio' => '5.50',
            ],
            [
                'id_producto_tipos' => $tipo,
                'nombre' => 'dorado tropical',
                'ingredientes' => 'lechuga, tomate, cebolla, millo, huevo, atún, gambas, piña, cangrejo, zanahoria y salsa rosa',
                'imagen' => '',
                'precio' => '5.50',
            ],
        ];

        // Añadir timestamps a cada producto
        $now = Carbon::now();
        $ensaladas = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $ensaladas);

        // Insertar en la tabla
        foreach ($ensaladas as $ensalada) {
            Producto::updateOrInsert(
                ['nombre' => $ensalada['nombre']], // clave
                $ensalada // valores
            );
        }
    }
}
