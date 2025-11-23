<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnos = [
            [
                'nombre' => 'Daniel',
                'apellido_paterno' => 'Calderón',
                'apellido_materno' => 'Ordijuela',
                'dni' => '12345678',
                'fecha_nacimiento' => '2005-03-12',
                'genero' => 'masculino',
                'email' => 'daniel.c90@example.com',
                'telefono' => '987654321',
                'direccion' => 'Av. Las Flores 123',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'María',
                'apellido_paterno' => 'Sánchez',
                'apellido_materno' => 'Torres',
                'dni' => '23456789',
                'fecha_nacimiento' => '2006-07-25',
                'genero' => 'femenino',
                'email' => 'maria.sanchez@example.com',
                'telefono' => '987654322',
                'direccion' => 'Jr. Los Olivos 456',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Luis',
                'apellido_paterno' => 'Ramírez',
                'apellido_materno' => 'Castillo',
                'dni' => '34567890',
                'fecha_nacimiento' => '2005-11-05',
                'genero' => 'masculino',
                'email' => 'luis.ramirez@example.com',
                'telefono' => '987654323',
                'direccion' => 'Calle Los Pinos 789',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'Fernández',
                'apellido_materno' => 'Morales',
                'dni' => '45678901',
                'fecha_nacimiento' => '2006-02-18',
                'genero' => 'femenino',
                'email' => 'ana.fernandez@example.com',
                'telefono' => '987654324',
                'direccion' => 'Av. El Sol 101',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Diego',
                'apellido_paterno' => 'Herrera',
                'apellido_materno' => 'López',
                'dni' => '56789012',
                'fecha_nacimiento' => '2005-09-30',
                'genero' => 'masculino',
                'email' => 'diego.herrera@example.com',
                'telefono' => '987654325',
                'direccion' => 'Jr. La Luna 202',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Valentina',
                'apellido_paterno' => 'Castro',
                'apellido_materno' => 'Ruiz',
                'dni' => '67890123',
                'fecha_nacimiento' => '2006-05-14',
                'genero' => 'femenino',
                'email' => 'valentina.castro@example.com',
                'telefono' => '987654326',
                'direccion' => 'Av. Los Andes 303',
                'estado' => 'activo',
            ],
        ];

        foreach ($alumnos as $alumno) {
            $codigo = 'ALU' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

            Alumno::updateOrCreate(
                ['dni' => $alumno['dni']],
                array_merge($alumno, ['codigo' => $codigo])
            );
        }
    }
}
