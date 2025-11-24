<div class="detail-list">

    <div class="detail-row">
        <h1 class="detail-h1">Información Personal:</h1>
    </div>

    <div class="detail-row">
        <span class="detail-label">Código:</span>
        <span class="detail-value">{{ $docente->codigo }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Nombre:</span>
        <span class="detail-value">{{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">DNI:</span>
        <span class="detail-value">{{ $docente->dni }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Fecha de nacimiento:</span>
        <span class="detail-value">{{ $docente->fecha_nacimiento }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Género:</span>
        <span class="detail-value">{{ ucfirst($docente->genero) }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Correo:</span>
        <span class="detail-value">{{ $docente->email ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Teléfono:</span>
        <span class="detail-value">{{ $docente->telefono ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Dirección:</span>
        <span class="detail-value">{{ $docente->direccion ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Especialidad:</span>
        <span class="detail-value">{{ $docente->especialidad ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Fecha de registro:</span>
        <span class="detail-value">{{ $docente->created_at ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Última actualización:</span>
        <span class="detail-value">{{ $docente->updated_at ?: '—' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Estado:</span>
        <span class="tag {{ $docente->estado == 'activo' ? 'tag--success' : 'tag--danger' }}">
            {{ ucfirst($docente->estado) }}
        </span>
    </div>

</div>
