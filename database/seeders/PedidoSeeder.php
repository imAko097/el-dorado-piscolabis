<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        // Datos de ejemplo para pedidos
        DB::table('pedidos')->insert([
            [
                'id_usuario' => 1, // ID de un usuario, asegúrate que este usuario exista
                'id_estado_pedido' => 1, // ID de un estado, asegúrate que exista en la tabla 'estado_pedidos'
                'direccion' => 'Calle Falsa 123, Ciudad, País',
                'observaciones' => 'Entrega preferentemente en la tarde',
                'telefono_contacto' => '555123456',
                'forma_pago' => 'Tarjeta de Crédito',
                'fecha_entrega' => Carbon::now()->addDays(1), // Fecha de entrega, un día después
                'subtotal' => 100.50,
                'descuento' => 10.00,
                'total' => 90.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_usuario' => 2,
                'id_estado_pedido' => 2,
                'direccion' => 'Avenida Siempre Viva 456, Springfield, USA',
                'observaciones' => 'Incluir mensaje en la caja',
                'telefono_contacto' => '555654321',
                'forma_pago' => 'Paypal',
                'fecha_entrega' => Carbon::now()->addDays(2),
                'subtotal' => 200.00,
                'descuento' => 20.00,
                'total' => 180.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}