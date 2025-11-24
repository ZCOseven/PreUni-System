<div class="detail-list">

    <div class="detail-row">
        <h1 class="detail-h1">Información Personal:</h1>
    </div>

    <div class="detail-row">
        <span class="detail-label">Código:</span>
        <span class="detail-value">{{ $alumno->codigo }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Nombre:</span>
        <span class="detail-value">{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">DNI:</span>
        <span class="detail-value">{{ $alumno->dni }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Fecha de nacimiento:</span>
        <span class="detail-value">{{ $alumno->fecha_nacimiento }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Género:</span>
        <span class="detail-value">{{ ucfirst($alumno->genero) }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Correo:</span>
        <span class="detail-value">{{ $alumno->email ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Teléfono:</span>
        <span class="detail-value">{{ $alumno->telefono ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Dirección:</span>
        <span class="detail-value">{{ $alumno->direccion ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Fecha de registro:</span>
        <span class="detail-value">{{ $alumno->created_at ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Última actualización:</span>
        <span class="detail-value">{{ $alumno->updated_at ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <h1 class="detail-h1">Información Académica:</h1>
    </div>

    <div class="detail-row">
    <span class="detail-label">Cursos:</span>
    <span class="detail-value">
        @php
            $cursos = $alumno->matriculas->flatMap(fn($m) => $m->asignaturas->pluck('curso.nombre'))->unique();
        @endphp

        @if($cursos->isNotEmpty())
            {{ $cursos->join(', ') }}
        @else
            —
        @endif
    </span>
</div>




    <!-- <div class="detail-row">
        <span class="detail-label">Estado:</span>
        <span class="tag {{ $alumno->estado == 'activo' ? 'tag--success' : 'tag--danger' }}">
            {{ ucfirst($alumno->estado) }}
        </span>
    </div> -->

</div>