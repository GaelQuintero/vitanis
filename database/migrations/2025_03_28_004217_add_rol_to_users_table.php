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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rol'); //Roles de la tabla users : 1 = Desarrollador y 2 = Reclutador
            $table->foreign('rol')->references('id')->on('roles')->onDelete('cascade'); // Relación con la tabla roles
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['rol']);
            $table->dropColumn('rol');
        });
    }
};
