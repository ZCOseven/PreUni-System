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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();

            // Alumno relacionado
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');

            // Periodo académico
            $table->string('periodo', 20); // ejemplo: "2025-I"

            // Estado de la matrícula
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            // Fecha de matrícula seleccionable
            $table->date('fecha_matricula');

            $table->text('observaciones')->nullable();

            // Timestamps y soft delete
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
