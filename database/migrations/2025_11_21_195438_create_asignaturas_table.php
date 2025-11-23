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
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();

            // Curso activo
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');

            // Docente activo
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');

            // Periodo tipo "2025-1"
            $table->string('periodo', 20);

            // Horario en formato JSON
            // {
            //   "dias": ["lunes","miercoles"],
            //   "hora_inicio": "09:00",
            //   "hora_fin": "11:00"
            // }
            $table->json('horario');

            // Aula select predefinido
            $table->string('aula', 50);

            // Estado
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->timestamps();
            $table->softDeletes(); // Para borrado lógico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};
