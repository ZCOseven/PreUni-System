<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asignaturas = [

            [
                'curso_id'   => 1,
                'docente_id' => 1,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Lunes', 'inicio' => '09:00', 'fin' => '11:00'],
                    ['dia' => 'Miercoles', 'inicio' => '09:00', 'fin' => '11:00'],
                ],
                'aula'       => 'AULA-101',
                'estado'     => 'activo',
            ],

            [
                'curso_id'   => 2,
                'docente_id' => 2,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Martes', 'inicio' => '10:00', 'fin' => '12:00'],
                    ['dia' => 'Jueves', 'inicio' => '08:00', 'fin' => '09:00'],
                ],
                'aula'       => 'AULA-102',
                'estado'     => 'activo',
            ],

            [
                'curso_id'   => 3,
                'docente_id' => 3,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Viernes', 'inicio' => '14:00', 'fin' => '16:00'],
                ],
                'aula'       => 'AULA-103',
                'estado'     => 'activo',
            ],

            [
                'curso_id'   => 4,
                'docente_id' => 4,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Lunes', 'inicio' => '08:00', 'fin' => '10:00'],
                    ['dia' => 'Martes', 'inicio' => '08:00', 'fin' => '10:00'],
                ],
                'aula'       => 'AULA-201',
                'estado'     => 'activo',
            ],

            [
                'curso_id'   => 5,
                'docente_id' => 5,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Miercoles', 'inicio' => '11:00', 'fin' => '13:00'],
                    ['dia' => 'Viernes', 'inicio' => '11:00', 'fin' => '13:00'],
                ],
                'aula'       => 'AULA-202',
                'estado'     => 'activo',
            ],

            [
                'curso_id'   => 1,
                'docente_id' => 3,
                'periodo'    => '2025-1',
                'horario'    => [
                    ['dia' => 'Sábado', 'inicio' => '08:00', 'fin' => '12:00'],
                ],
                'aula'       => 'AULA-103',
                'estado'     => 'activo',
            ],
        ];

        foreach ($asignaturas as $asig) {
            Asignatura::create($asig);
        }
    }
}
