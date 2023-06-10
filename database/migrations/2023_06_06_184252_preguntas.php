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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->text('respuesta1');
            $table->boolean('correct1');
            $table->text('respuesta2');
            $table->boolean('correct2');
            $table->text('respuesta3')->nullable();
            $table->boolean('correct3')->nullable();
            $table->text('respuesta4')->nullable();
            $table->boolean('correct4')->nullable();
            $table->unsignedBigInteger('evaluacion_id');
            $table->foreign('evaluacion_id')->references('id')->on('evaluaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
