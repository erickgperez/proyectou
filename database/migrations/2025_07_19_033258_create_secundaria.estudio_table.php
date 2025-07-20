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
        Schema::create('secundaria.estudio', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('anio');
            $table->decimal('nota_promocion', total: 6, places: 2)->nullable();
            $table->foreignId('estudiante_id');
            $table->foreignId('carrera_id');
            $table->foreignId('institucion_id');
            $table->foreign('estudiante_id')->references('id')->on('secundaria.estudiante');
            $table->foreign('carrera_id')->references('id')->on('secundaria.carrera');
            $table->foreign('institucion_id')->references('id')->on('secundaria.institucion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secundaria.estudio');
    }
};
