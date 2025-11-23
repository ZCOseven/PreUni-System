<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $cursos = [
            [
                'nombre' => 'Matemáticas Básicas',
                'descripcion' => 'Curso introductorio de matemáticas, enfocado en aritmética y álgebra básica.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Física General',
                'descripcion' => 'Fundamentos de física clásica, incluyendo mecánica y termodinámica.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Química Orgánica',
                'descripcion' => 'Estudio de compuestos orgánicos y sus reacciones más importantes.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Historia Universal',
                'descripcion' => 'Recorrido por la historia del mundo desde la antigüedad hasta la contemporaneidad.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Literatura y Redacción',
                'descripcion' => 'Análisis de textos literarios y desarrollo de habilidades de escritura.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Informática Básica',
                'descripcion' => 'Conceptos fundamentales de computación, software y hardware.',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Educación Física',
                'descripcion' => 'Desarrollo de habilidades motrices y hábitos de vida saludable.',
                'estado' => 'activo',
            ],
        ];

        foreach ($cursos as $curso) {
            Curso::updateOrCreate(
                ['nombre' => $curso['nombre']],
                $curso
            );
        }
    }
}
