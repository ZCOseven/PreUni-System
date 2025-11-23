<div class="alumno__detalle">

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Código:</span>
        <span>{{ $alumno->codigo }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Nombre:</span>
        <span>{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">DNI:</span>
        <span>{{ $alumno->dni }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Fecha de nacimiento:</span>
        <span>{{ $alumno->fecha_nacimiento }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Género:</span>
        <span>{{ ucfirst($alumno->genero) }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Correo:</span>
        <span>{{ $alumno->email ?: '—' }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Teléfono:</span>
        <span>{{ $alumno->telefono ?: '—' }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Dirección:</span>
        <span>{{ $alumno->direccion ?: '—' }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Fecha de registro:</span>
        <span>{{ $alumno->created_at ?: '—' }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Ultima actualización:</span>
        <span>{{ $alumno->updated_at ?: '—' }}</span>
    </div>

    <div class="alumno__detail-row">
        <span class="alumno__detail-label">Estado:</span>

        <span class="alumno__tag 
            {{ $alumno->estado == 'activo' ? 'alumno__tag--success' : 'alumno__tag--danger' }}">
            {{ ucfirst($alumno->estado) }}
        </span>
    </div>

</div>
