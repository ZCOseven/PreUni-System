<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alumnos';

    protected $fillable = [
        'codigo',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'dni',
        'fecha_nacimiento',
        'genero',
        'email',
        'telefono',
        'direccion',
        'estado',
    ];

    // Código único ALUYYYY-XXXXX
    protected static function booted()
    {
        static::creating(function ($alumno) {
            $year = date('Y'); // año actual
            do {
                $randomNumbers = mt_rand(10000, 99999);
                $codigo = "ALU{$year}-{$randomNumbers}";
            } while (self::where('codigo', $codigo)->exists());

            $alumno->codigo = $codigo;
        });
    }
}
