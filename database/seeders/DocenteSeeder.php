<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $docentes = [
            [
                'nombre' => 'Carlos',
                'apellido_paterno' => 'Vargas',
                'apellido_materno' => 'Mendoza',
                'dni' => '11223344',
                'fecha_nacimiento' => '1980-04-12',
                'genero' => 'masculino',
                'email' => 'carlos.vargas@example.com',
                'telefono' => '987111111',
                'direccion' => 'Av. Principal 123',
                'especialidad' => 'Matemáticas',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Lucía',
                'apellido_paterno' => 'Rojas',
                'apellido_materno' => 'Salazar',
                'dni' => '22334455',
                'fecha_nacimiento' => '1985-09-20',
                'genero' => 'femenino',
                'email' => 'lucia.rojas@example.com',
                'telefono' => '987222222',
                'direccion' => 'Calle Secundaria 456',
                'especialidad' => 'Inglés',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Miguel',
                'apellido_paterno' => 'Torres',
                'apellido_materno' => 'Castillo',
                'dni' => '33445566',
                'fecha_nacimiento' => '1978-12-05',
                'genero' => 'masculino',
                'email' => 'miguel.torres@example.com',
                'telefono' => '987333333',
                'direccion' => 'Jr. Los Pinos 789',
                'especialidad' => 'Ciencia y Tecnología',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'Fernández',
                'apellido_materno' => 'Morales',
                'dni' => '44556677',
                'fecha_nacimiento' => '1982-02-18',
                'genero' => 'femenino',
                'email' => 'ana.fernandez@example.com',
                'telefono' => '987444444',
                'direccion' => 'Av. El Sol 101',
                'especialidad' => 'Historia',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Diego',
                'apellido_paterno' => 'Herrera',
                'apellido_materno' => 'López',
                'dni' => '55667788',
                'fecha_nacimiento' => '1975-09-30',
                'genero' => 'masculino',
                'email' => 'diego.herrera@example.com',
                'telefono' => '987555555',
                'direccion' => 'Jr. La Luna 202',
                'especialidad' => 'Arte',
                'estado' => 'activo',
            ],
            [
                'nombre' => 'Valentina',
                'apellido_paterno' => 'Castro',
                'apellido_materno' => 'Ruiz',
                'dni' => '66778899',
                'fecha_nacimiento' => '1988-05-14',
                'genero' => 'femenino',
                'email' => 'valentina.castro@example.com',
                'telefono' => '987666666',
                'direccion' => 'Av. Los Andes 303',
                'especialidad' => 'Educación Física',
                'estado' => 'activo',
            ],
        ];

        foreach ($docentes as $docente) {
            $codigo = 'DOC'.date('Y').'-'.str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

            Docente::updateOrCreate(
                ['dni' => $docente['dni']],
                array_merge($docente, ['codigo' => $codigo])
            );
        }
    }
}
