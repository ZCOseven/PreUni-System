<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Corre el seeder de administradores.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'dc644373@gmail.com'],
            [
                'name' => 'Daniel Calderon',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ]
        );
    }
}
