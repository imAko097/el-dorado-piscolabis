<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('usuarios', UsuariosController::class);
Route::resource('productos', ProductoController::class);

require __DIR__.'/auth.php';

// ruta para pagina de inicio el dorado
Route::get('/', [InicioController::class, 'inicio'])->name('inicio');
Route::get('/menu/{categoria?}', [InicioController::class, 'menu'])->name('menu');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');
Route::get('/sobrenosotros', [InicioController::class, 'sobreNosotros'])->name('sobrenosotros');

// Rutas del carrito y checkout
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout');
Route::get('/pedido/confirmacion/{id}', \App\Livewire\PedidoConfirmacion::class)->name('pedido.confirmacion');

Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos/mis-pedidos', \App\Livewire\Pedidos\MisPedidos::class)->name('pedidos.mis-pedidos');
});