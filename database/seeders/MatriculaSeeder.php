<?php

namespace Database\Seeders;

use App\Models\Matricula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matriculas = [
            [
                'alumno_id' => 1,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-01',
                'observaciones' => 'Estudiante nuevo en la escuela de informática (2025-I).',
                'asignaturas' => [1, 2, 3],
            ],
            [
                'alumno_id' => 2,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-02',
                'observaciones' => 'Estudiante con IQ mayor a 100.',
                'asignaturas' => [2, 4],
            ],
            [
                'alumno_id' => 3,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-03',
                'observaciones' => 'Estudiante egresado de un colegio estranjero.',
                'asignaturas' => [1, 5],
            ],
            [
                'alumno_id' => 4,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-04',
                'observaciones' => 'Estudiante con discapacidad visual.',
                'asignaturas' => [3, 4, 5],
            ],
            [
                'alumno_id' => 5,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-05',
                'observaciones' => 'Estudiante con discapacidad auditiva.',
                'asignaturas' => [1, 2],
            ],
            [
                'alumno_id' => 6,
                'periodo' => '2025-I',
                'estado' => 'activo',
                'fecha_matricula' => '2025-03-06',
                'observaciones' => 'Estudiante con habilidades especiales.',
                'asignaturas' => [3, 5],
            ],
        ];

        foreach ($matriculas as $m) {
            // Crear matrícula
            $matricula = Matricula::create([
                'alumno_id' => $m['alumno_id'],
                'periodo' => $m['periodo'],
                'estado' => $m['estado'],
                'fecha_matricula' => $m['fecha_matricula'],
                'observaciones'   => $m['observaciones'],
            ]);

            // Asociar asignaturas en tabla pivot
            $matricula->asignaturas()->attach($m['asignaturas']);
        }
    }
}
