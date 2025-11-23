<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'docentes';

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
        'especialidad',
        'estado',
    ];

    // Código único DOCYYYY-XXXXX
    protected static function booted()
    {
        static::creating(function ($docente) {
            $year = date('Y'); // año actual
            do {
                $randomNumbers = mt_rand(10000, 99999);
                $codigo = "DOC{$year}-{$randomNumbers}";
            } while (self::where('codigo', $codigo)->exists());

            $docente->codigo = $codigo;
        });
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'docente_id', 'id')
            ->whereNull('deleted_at');
    }
}
