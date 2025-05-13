<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Livewire\Menu;



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// ruta para pagina de inicio el dorado
Route::get('/', [InicioController::class, 'inicio'])->name('inicio');
Route::get('/menu', [InicioController::class, 'menu'])->name('menu');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');
Route::get('/sobrenosotros', [InicioController::class, 'sobreNosotros'])->name('sobrenosotros');

// Submenus

Route::get('/menu/{categoria?}', Menu::class)->name('menu');