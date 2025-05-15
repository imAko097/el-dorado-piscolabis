<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CarruselImagenes;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('usuarios', UsuariosController::class);
Route::resource('productos', ProductoController::class);
Route::resource('carrusel_imagenes', \App\Http\Controllers\CarruselImagenes::class);


require __DIR__.'/auth.php';

// ruta para pagina de inicio el dorado
Route::get('/', [InicioController::class, 'inicio'])->name('inicio');
Route::get('/menu/{categoria?}', [InicioController::class, 'menu'])->name('menu');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');
Route::get('/sobrenosotros', [InicioController::class, 'sobreNosotros'])->name('sobrenosotros');
Route::post('/carrusel/update-order', [CarruselImagenes::class, 'updateOrder'])->name('carrusel.updateOrder');

// Rutas del carrito y checkout
Route::get('/confirmar-pedido', function () {
    return view('pedido.checkout');
})->name('checkout');

// Pedido confirmado
Route::get('/pedido/confirmacion/{id}', function ($id) {
    return view('pedido.confirmacion', compact('id'));
})->name('pedido.confirmacion');

Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos/mis-pedidos', \App\Livewire\Pedidos\MisPedidos::class)->name('pedidos.mis-pedidos');
});