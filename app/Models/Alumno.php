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

    public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function cursos()
    {
        // Trae todas las asignaturas de todas las matrículas del alumno
        return $this->hasManyThrough(
            Asignatura::class,
            MatriculaAsignatura::class,
            'matricula_id',    // FK en matricula_asignatura hacia matricula
            'id',              // FK de asignaturas
            'id',              // PK de alumno
            'asignatura_id'    // FK de asignatura en matricula_asignatura
        )->join('matriculas', 'matriculas.id', '=', 'matricula_asignatura.matricula_id')
            ->where('matriculas.alumno_id', $this->id)
            ->select('asignaturas.*')
            ->distinct();
    }
}
