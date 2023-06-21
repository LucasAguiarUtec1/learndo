<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    protected $table = 'resultado';

    public function up(): void
    {
        Schema::create('resultado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nota');
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("evaluacion_id")->references("id")->on("evaluaciones")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado');
    }
};
