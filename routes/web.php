<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('usuarios', UsuariosController::class);
Route::resource('productos', ProductoController::class);

require __DIR__.'/auth.php';
