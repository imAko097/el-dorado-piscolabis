<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductosSeeder\BocadilloSeeder;
use Database\Seeders\ProductosSeeder\SandwichSeeder;
use Database\Seeders\ProductosSeeder\CroissantSeeder;
use Database\Seeders\ProductosSeeder\KebabSeeder;
use Database\Seeders\ProductosSeeder\HamburguesaSeeder;
use Database\Seeders\EstadoPedidoSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductoTipoSeeder::class,
            BocadilloSeeder::class,
            SandwichSeeder::class,
            CroissantSeeder::class,
            KebabSeeder::class,
            HamburguesaSeeder::class,
            EstadoPedidoSeeder::class,
        ]);
    }
}
