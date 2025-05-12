<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id(); // ID único para la tabla
            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade'); // Relación con la tabla 'productos'
            $table->foreignId('id_pedido')->constrained('pedidos')->onDelete('cascade'); // Relación con la tabla 'pedidos'
            $table->string('comentario')->nullable(); // Comentario sobre el producto, como "sin cebolla", "sin queso", etc.
            $table->integer('cantidad'); // Cantidad del producto en el pedido
            $table->decimal('precio_unitario', 8, 2); // Precio unitario del producto (tomado de la tabla 'productos')
            $table->decimal('precio_total', 8, 2); // Precio total (precio_unitario * cantidad)
            $table->timestamps(); // Timestamps (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_productos');
    }
};
