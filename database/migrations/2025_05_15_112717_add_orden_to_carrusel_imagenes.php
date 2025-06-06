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
        Schema::table('carrusel_imagenes', function (Blueprint $table) {
            $table->integer('orden')->default(0)->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrusel_imagenes', function (Blueprint $table) {
            $table->dropColumn('orden');
        });
    }
};
