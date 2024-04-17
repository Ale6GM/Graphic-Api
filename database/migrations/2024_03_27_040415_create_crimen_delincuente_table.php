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
        Schema::create('crimen_delincuente', function (Blueprint $table) {
            $table->unsignedBigInteger('crimen_id');
            $table->unsignedBigInteger('delincuente_id');

            $table->foreign('crimen_id')->references('id')->on('crimens')->onUpdate('cascade')->onDelete(null);
            $table->foreign('delincuente_id')->references('id')->on('delincuentes')->onUpdate('cascade')->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crimen_delincuente');
    }
};
