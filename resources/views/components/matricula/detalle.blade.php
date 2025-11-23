<div class="matricula__detalle">

    <!-- Alumno -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Alumno:</span>
        <span>{{ $matricula->alumno->nombreCompleto() ?? ($matricula->alumno->nombre.' '.$matricula->alumno->apellido_paterno) }}</span>
    </div>

    <!-- Periodo -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Periodo:</span>
        <span>{{ $matricula->periodo ?? '—' }}</span>
    </div>

    <!-- Fecha de matrícula -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Fecha de matrícula:</span>
        <span>{{ $matricula->fecha_matricula ? \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') : '—' }}</span>
    </div>

    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Observaciones:</span>
        <span>{{ $matricula->observaciones ?? '—' }}</span>
    </div>

    <!-- Asignaturas inscritas -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Asignaturas inscritas:</span>
        <span>
            @if($matricula->asignaturas && count($matricula->asignaturas) > 0)
                @foreach($matricula->asignaturas as $asignatura)
                    {{ $asignatura->curso->nombre ?? 'Curso deshabilitado' }} - 
                    {{ $asignatura->docente->nombre ?? '' }} {{ $asignatura->docente->apellido_paterno ?? '' }}
                    @if(!$loop->last), @endif
                @endforeach
            @else
                —
            @endif
        </span>
    </div>

    <!-- Estado -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Estado:</span>
        <span class="matricula__tag 
            {{ $matricula->estado == 'activo' ? 'matricula__tag--success' : 'matricula__tag--danger' }}">
            {{ ucfirst($matricula->estado) ?? '—' }}
        </span>
    </div>

    <!-- Creación y actualización -->
    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Creado:</span>
        <span>{{ $matricula->created_at ? $matricula->created_at->format('d/m/Y H:i') : '—' }}</span>
    </div>

    <div class="matricula__detail-row">
        <span class="matricula__detail-label">Última actualización:</span>
        <span>{{ $matricula->updated_at ? $matricula->updated_at->format('d/m/Y H:i') : '—' }}</span>
    </div>

</div>
