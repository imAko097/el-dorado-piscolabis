<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tipos de productos
        $estados = [
            'recibido',
            'en preparación',
            'en camino',
            'listo para recoger',
            'entregado',
            'cancelado',
        ];

        // Poblar base de datos
        foreach ($estados as $estado) {
            DB::table('estado_pedido')->updateOrInsert([
                'estado' => $estado,
            ]);
        }
    }
}
