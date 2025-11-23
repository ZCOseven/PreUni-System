<div class="asignatura__detalle">

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Curso:</span>
        <span>{{ $asignatura->curso->nombre ?? '—' }}</span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Docente:</span>
        <span>
            {{ $asignatura->docente->codigo ? $asignatura->docente->codigo . ' - ' : '' }}
            {{ $asignatura->docente->nombre ?? '' }}
            {{ $asignatura->docente->apellido_paterno ?? '' }}
            {{ $asignatura->docente->apellido_materno ?? '' }}
        </span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Periodo:</span>
        <span>{{ $asignatura->periodo ?? '—' }}</span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Horario:</span>
        <span>
            @if(is_array($asignatura->horario))
                @if(isset($asignatura->horario['dias']))
                    {{ implode(', ', array_map('ucfirst', $asignatura->horario['dias'])) }}
                    | {{ $asignatura->horario['hora_inicio'] ?? '—' }} - {{ $asignatura->horario['hora_fin'] ?? '—' }}
                @else
                    @foreach($asignatura->horario as $h)
                        {{ ucfirst($h['dia'] ?? '—') }} | {{ $h['inicio'] ?? '—' }} - {{ $h['fin'] ?? '—' }}@if(!$loop->last) / @endif
                    @endforeach
                @endif
            @else
                —
            @endif
        </span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Aula:</span>
        <span>{{ $asignatura->aula ?? '—' }}</span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Fecha de registro:</span>
        <span>{{ $asignatura->created_at ? $asignatura->created_at->format('d/m/Y H:i') : '—' }}</span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Última actualización:</span>
        <span>{{ $asignatura->updated_at ? $asignatura->updated_at->format('d/m/Y H:i') : '—' }}</span>
    </div>

    <div class="asignatura__detail-row">
        <span class="asignatura__detail-label">Estado:</span>
        <span class="asignatura__tag 
            {{ $asignatura->estado == 'activo' ? 'asignatura__tag--success' : 'asignatura__tag--danger' }}">
            {{ ucfirst($asignatura->estado) ?? '—' }}
        </span>
    </div>

</div>
