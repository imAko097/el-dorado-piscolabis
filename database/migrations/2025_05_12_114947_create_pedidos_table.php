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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade'); // Relación con la tabla 'users'
            $table->foreignId('id_estado_pedido')->constrained('estado_pedido')->onDelete('cascade'); // Relación con la tabla 'estado_pedidos'
            $table->string('direccion', 500)->nullable(); // Dirección de entrega, puede ser nula
            $table->text('observaciones')->nullable(); // Observaciones, puede ser nulo
            $table->string('telefono_contacto', 9); // Teléfono de contacto
            $table->string('forma_pago', 50); // Forma de pago
            $table->timestamp('fecha_entrega')->nullable(); // Fecha de entrega, puede ser nula
            $table->decimal('subtotal', 8, 2); // Subtotal del pedido
            $table->decimal('descuento', 8, 2)->default(0); // Descuento del pedido
            $table->decimal('total', 8, 2); // Total del pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
