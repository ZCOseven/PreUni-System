<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignatura extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asignaturas';

    protected $fillable = [
        'curso_id',
        'docente_id',
        'periodo',
        'horario',
        'aula',
        'estado',
    ];

    protected $casts = [
        'horario' => 'array', // JSON → array automático
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Relación con cursos (solo cursos activos en el sistema)
    public function curso()
    {
        return $this->belongsTo(Curso::class)->where('estado', 'activo');
    }

    // Relación con docentes (solo docentes activos)
    public function docente()
    {
        return $this->belongsTo(Docente::class)->where('estado', 'activo');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar solo asignaturas activas
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activo');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    // Devuelve algo así como: "Lun, Mié | 09:00 - 11:00"
    public function horarioFormateado()
{
    if (empty($this->horario)) return null;

    // Decodificar si es JSON string
    $horario = is_string($this->horario) ? json_decode($this->horario, true) : $this->horario;

    if (!is_array($horario)) return null;

    $mapaDias = [
        'lunes' => 'Lun',
        'martes' => 'Mar',
        'miercoles' => 'Mié',
        'jueves' => 'Jue',
        'viernes' => 'Vie',
        'sabado' => 'Sáb',
        'domingo' => 'Dom',
    ];

    // Caso 1: formato general (dias + hora_inicio + hora_fin)
    if (isset($horario['dias']) && isset($horario['hora_inicio']) && isset($horario['hora_fin'])) {
        $diasAbrev = array_map(fn($d) => $mapaDias[strtolower($d)] ?? $d, $horario['dias']);
        $diasTexto = implode(', ', $diasAbrev);
        return "{$diasTexto} | {$horario['hora_inicio']} - {$horario['hora_fin']}";
    }

    // Caso 2: formato por día (actualizado con agrupamiento por hora)
    if (isset($horario[0]['dia'])) {
        $agrupados = [];
        foreach ($horario as $h) {
            $key = ($h['inicio'] ?? '---') . '-' . ($h['fin'] ?? '---');
            if (!isset($agrupados[$key])) {
                $agrupados[$key] = [];
            }
            $agrupados[$key][] = $h['dia'];
        }

        $resultado = [];
        foreach ($agrupados as $horarioHoras => $dias) {
            $diasAbrev = array_map(fn($d) => $mapaDias[strtolower($d)] ?? $d, $dias);
            $resultado[] = implode(', ', $diasAbrev) . ' | ' . str_replace('-', ' - ', $horarioHoras);
        }

        return implode(' / ', $resultado);
    }

    return null;
}

}
