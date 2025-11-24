<div class="detail-list">

    <!-- TÍTULO -->
    <div class="detail-row">
        <h1 class="detail-h1">Información de la Asignatura:</h1>
    </div>

    <!-- CURSO -->
    <div class="detail-row">
        <span class="detail-label">Curso:</span>
        <span class="detail-value">{{ $asignatura->curso->nombre ?? '—' }}</span>
    </div>

    <!-- DOCENTE -->
    <div class="detail-row">
        <span class="detail-label">Docente:</span>
        <span class="detail-value">
            @if($asignatura->docente)
                {{ $asignatura->docente->codigo ? $asignatura->docente->codigo . ' - ' : '' }}
                {{ $asignatura->docente->nombre }}
                {{ $asignatura->docente->apellido_paterno }}
                {{ $asignatura->docente->apellido_materno }}
            @else
                —
            @endif
        </span>
    </div>

    <!-- PERIODO -->
    <div class="detail-row">
        <span class="detail-label">Periodo:</span>
        <span class="detail-value">{{ $asignatura->periodo ?? '—' }}</span>
    </div>

    <!-- HORARIO -->
    <div class="detail-row">
        <span class="detail-label">Horario:</span>
        <span class="detail-value">
            @if(is_array($asignatura->horario))

                {{-- Formato NUEVO: ['dias' => [], 'hora_inicio' => '', 'hora_fin' => ''] --}}
                @if(isset($asignatura->horario['dias']))
                    {{ implode(', ', array_map('ucfirst', $asignatura->horario['dias'])) }}
                    | {{ $asignatura->horario['hora_inicio'] ?? '—' }}
                    - {{ $asignatura->horario['hora_fin'] ?? '—' }}

                {{-- Formato ANTIGUO: array de objetos/días --}}
                @else
                    @foreach($asignatura->horario as $h)
                        {{ ucfirst($h['dia'] ?? '—') }}
                        | {{ $h['inicio'] ?? '—' }} - {{ $h['fin'] ?? '—' }}
                        @if(!$loop->last) / @endif
                    @endforeach
                @endif

            @else
                —
            @endif
        </span>
    </div>

    <!-- AULA -->
    <div class="detail-row">
        <span class="detail-label">Aula:</span>
        <span class="detail-value">{{ $asignatura->aula ?? '—' }}</span>
    </div>

    <!-- FECHA REGISTRO -->
    <div class="detail-row">
        <span class="detail-label">Fecha de registro:</span>
        <span class="detail-value">
            {{ $asignatura->created_at ? $asignatura->created_at->format('d/m/Y H:i') : '—' }}
        </span>
    </div>

    <!-- ÚLTIMA ACTUALIZACIÓN -->
    <div class="detail-row">
        <span class="detail-label">Última actualización:</span>
        <span class="detail-value">
            {{ $asignatura->updated_at ? $asignatura->updated_at->format('d/m/Y H:i') : '—' }}
        </span>
    </div>

    <!-- ESTADO -->
    <div class="detail-row">
        <span class="detail-label">Estado:</span>
        <span class="tag {{ $asignatura->estado == 'activo' ? 'tag--success' : 'tag--danger' }}">
            {{ ucfirst($asignatura->estado) }}
        </span>
    </div>

</div>
