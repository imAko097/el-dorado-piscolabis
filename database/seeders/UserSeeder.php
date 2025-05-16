<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios de ejemplo
        User::insert([
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'), // Contraseña cifrada
                'remember_token' => Str::random(60),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'María López',
                'email' => 'maria.lopez@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password456'),
                'remember_token' => Str::random(60),
                'role' => 'empleado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Carlos Martínez',
                'email' => 'carlos.martinez@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password789'),
                'remember_token' => Str::random(60),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lucía Fernández',
                'email' => 'lucia.fernandez@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password101'),
                'remember_token' => Str::random(60),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
