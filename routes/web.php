<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CarruselImagenes;
use Illuminate\Support\Facades\Auth;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::get('/pedidos/mis-pedidos', \App\Livewire\Pedidos\MisPedidos::class)->name('pedidos.mis-pedidos');
    Route::get('carrusel_imagenes', [CarruselImagenes::class, 'index'])->name('carrusel.index');
    Route::post('/carrusel/update-order', [CarruselImagenes::class, 'updateOrder'])->name('carrusel.updateOrder');
});


Route::get('/', [InicioController::class, 'inicio'])->name('inicio');
Route::get('/menu/{categoria?}', [InicioController::class, 'menu'])->name('menu');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');
Route::get('/sobrenosotros', [InicioController::class, 'sobreNosotros'])->name('sobrenosotros');

Route::get('/confirmar-pedido', function () {
    return view('pedido.checkout');
})->name('checkout');

Route::get('/pedido/confirmacion/{id}', function ($id) {
    return view('pedido.confirmacion', compact('id'));
})->name('pedido.confirmacion');

// Auth scaffolding (login, register, etc.)
require __DIR__.'/auth.php';