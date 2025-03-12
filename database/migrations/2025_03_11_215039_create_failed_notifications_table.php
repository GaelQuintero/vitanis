<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('failed_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('title');
            $table->text('message');
            $table->string('url')->nullable();
            $table->boolean('sent')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('failed_notifications');
    }
};
