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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('inventarios')->onDelete('cascade');  // FK a productos
            $table->enum('tipo', ['entrada', 'salida']);  // Tipo de movimiento (entrada o salida)
            $table->unsignedInteger('cantidad');  // Cantidad de productos en este movimiento
            $table->text('descripcion')->nullable();  // Descripción del movimiento (opcional)
            $table->timestamps();  // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
