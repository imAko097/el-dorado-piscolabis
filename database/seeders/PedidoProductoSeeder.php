<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Producto;

class PedidoProductoSeeder extends Seeder
{
    public function run()
    {
        // Obtener algunos pedidos y productos para hacer la relación
        $pedidos = Pedido::all();
        $productos = Producto::all();

        // Verificar si hay productos y pedidos disponibles
        if ($pedidos->isEmpty() || $productos->isEmpty()) {
            echo "No hay productos o pedidos disponibles para crear la relación.\n";
            return;
        }

        // Crear una relación de ejemplo entre pedidos y productos
        foreach ($pedidos as $pedido) {
            // Seleccionar algunos productos aleatorios para asociar con este pedido
            $productosSeleccionados = $productos->random(rand(1, 5)); // Seleccionamos entre 1 y 5 productos aleatorios para cada pedido

            foreach ($productosSeleccionados as $producto) {
                // Calcular el precio total basado en cantidad y precio unitario
                $cantidad = rand(1, 5); // Cantidad aleatoria entre 1 y 5
                $precio_unitario = $producto->precio; // Suponiendo que el producto tiene un campo 'precio'
                $precio_total = $cantidad * $precio_unitario;

                // Insertar la relación en la tabla pivot (pedido_productos)
                DB::table('pedido_productos')->insert([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $producto->id,
                    'cantidad' => $cantidad,
                    'comentario' => 'Comentario de prueba para ' . $producto->nombre, // Comentario de prueba
                    'precio_unitario' => $precio_unitario,
                    'precio_total' => $precio_total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
