<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductosSeeder\BocadilloSeeder;
use Database\Seeders\ProductosSeeder\SandwichSeeder;
use Database\Seeders\ProductosSeeder\CroissantSeeder;
use Database\Seeders\ProductosSeeder\KebabSeeder;
use Database\Seeders\ProductosSeeder\HamburguesaSeeder;
use Database\Seeders\ProductosSeeder\PerritoSeeder;
use Database\Seeders\ProductosSeeder\EntranteSeeder;
use Database\Seeders\ProductosSeeder\PapaSeeder;
use Database\Seeders\ProductosSeeder\EnsaladaSeeder;
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
            PerritoSeeder::class,
            EntranteSeeder::class,
            PapaSeeder::class,
            EnsaladaSeeder::class,
            EstadoPedidoSeeder::class,
        ]);
    }
}
