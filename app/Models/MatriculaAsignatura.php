<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaAsignatura extends Model
{
    use HasFactory;

    protected $table = 'matricula_asignatura';

    protected $fillable = [
        'matricula_id',
        'asignatura_id',
    ];

    /**
     * Relación con Matricula
     */
    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    /**
     * Relación con Asignatura
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}
