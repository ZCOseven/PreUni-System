<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matricula extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matriculas';

    protected $fillable = [
        'alumno_id',
        'periodo',
        'estado',
        'fecha_matricula',
        'observaciones',
    ];

    /**
     * Relación con Alumno
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    /**
     * Relación muchos a muchos con Asignatura
     */
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'matricula_asignatura', 'matricula_id', 'asignatura_id')
            ->withTimestamps();
    }
}
