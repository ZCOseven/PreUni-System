<div class="detail-list">

    <div class="detail-row">
        <h1 class="detail-h1">Información de Matrícula:</h1>
    </div>

    <div class="detail-row">
        <span class="detail-label">Alumno:</span>
        <span class="detail-value">
            {{ $matricula->alumno->nombreCompleto() ?? ($matricula->alumno->nombre.' '.$matricula->alumno->apellido_paterno) }}
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Periodo:</span>
        <span class="detail-value">{{ $matricula->periodo ?? '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Fecha de matrícula:</span>
        <span class="detail-value">
            {{ $matricula->fecha_matricula ? \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') : '—' }}
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Observaciones:</span>
        <span class="detail-value">{{ $matricula->observaciones ?? '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Asignaturas inscritas:</span>
        <span class="detail-value">
            @if($matricula->asignaturas && count($matricula->asignaturas) > 0)
                @foreach($matricula->asignaturas as $asignatura)
                    {{ $asignatura->curso->nombre ?? 'Curso deshabilitado' }} 
                    ({{ $asignatura->docente->nombre ?? '' }} {{ $asignatura->docente->apellido_paterno ?? '' }})
                    @if(!$loop->last), @endif
                @endforeach
            @else
                —
            @endif
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Creado:</span>
        <span class="detail-value">
            {{ $matricula->created_at ? $matricula->created_at->format('d/m/Y H:i') : '—' }}
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Última actualización:</span>
        <span class="detail-value">
            {{ $matricula->updated_at ? $matricula->updated_at->format('d/m/Y H:i') : '—' }}
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Estado:</span>
        <span class="tag {{ $matricula->estado == 'activo' ? 'tag--success' : 'tag--danger' }}">
            {{ ucfirst($matricula->estado) ?? '—' }}
        </span>
    </div>
</div>