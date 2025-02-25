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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();  // ID del producto
            $table->string('nombre', 255);  // Nombre del producto
            $table->text('descripcion')->nullable();  // Descripción del producto (opcional)
            $table->string('codigo', 100)->unique();  // Código único del producto
            $table->unsignedInteger('cantidad_actual')->default(0);  // Cantidad actual en stock
            $table->decimal('precio', 10, 2);  // Precio del producto
            $table->timestamps();  // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
