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
        Schema::create('crimens', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_crimen')->nullable();
            $table->string('zona')->nullable();
            $table->date('fecha_ocurrida')->nullable();
            $table->text('modus_operandi')->nullable();
            $table->string('conocimiento_perpetrador')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crimens');
    }
};
