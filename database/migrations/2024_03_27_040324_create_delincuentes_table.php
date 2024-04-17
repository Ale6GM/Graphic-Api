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
        Schema::create('delincuentes', function (Blueprint $table) {
            $table->id();
            $table->integer('edad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('genero')->nullable();
            $table->string('antecedentes')->nullable();
            $table->string('relacion_victima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delincuentes');
    }
};
