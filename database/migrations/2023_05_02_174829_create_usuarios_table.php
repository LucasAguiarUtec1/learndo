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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('nickname');
            $table->string('email');
            $table->string('telefono');
            $table->string('nombre');
            $table->text('biografia');
            $table->string('password');
            $table->string('tipo_usuario');
            $table->primary(['nickname', 'tipo_usuario']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
