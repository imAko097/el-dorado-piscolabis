<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductosSeeder\BocadilloSeeder;
use Database\Seeders\ProductosSeeder\SandwichSeeder;


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
        ]);
    }
}
