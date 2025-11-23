<div class="docente__detalle">

    <div class="docente__detail-row">
        <span class="docente__detail-label">Código:</span>
        <span>{{ $docente->codigo }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Nombre:</span>
        <span>{{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">DNI:</span>
        <span>{{ $docente->dni }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Fecha de nacimiento:</span>
        <span>{{ $docente->fecha_nacimiento }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Género:</span>
        <span>{{ ucfirst($docente->genero) }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Correo:</span>
        <span>{{ $docente->email ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Teléfono:</span>
        <span>{{ $docente->telefono ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Dirección:</span>
        <span>{{ $docente->direccion ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Especialidad:</span>
        <span>{{ $docente->especialidad ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Fecha de registro:</span>
        <span>{{ $docente->created_at ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Última actualización:</span>
        <span>{{ $docente->updated_at ?: '—' }}</span>
    </div>

    <div class="docente__detail-row">
        <span class="docente__detail-label">Estado:</span>

        <span class="docente__tag 
            {{ $docente->estado == 'activo' ? 'docente__tag--success' : 'docente__tag--danger' }}">
            {{ ucfirst($docente->estado) }}
        </span>
    </div>

</div>
