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
        Schema::create('secundaria.estudiante', function (Blueprint $table) {
            $table->id();

            $table->string('nie', length: 15)->unique();
            $table->string('correo', length: 150)->unique()->nullable();
            $table->string('primer_nombre', length: 100);
            $table->string('segundo_nombre', length: 100)->nullable();
            $table->string('tercer_nombre', length: 100)->nullable();
            $table->string('primer_apellido', length: 100);
            $table->string('segundo_apellido', length: 100)->nullable();
            $table->string('tercer_apellido', length: 100)->nullable();
            $table->foreignId('sexo_id');
            $table->foreign('sexo_id')->references('id')->on('public.sexo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secundaria.estudiante');
    }
};
