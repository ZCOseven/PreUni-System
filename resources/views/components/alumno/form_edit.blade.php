<form action="{{ route('alumnos.save') }}" method="POST" class="alumno__form">
    @csrf
    <input type="hidden" name="id" value="{{ $alumno->id }}">

    <div class="alumno__group">
        <label class="alumno__label">Nombre</label>
        <input type="text" name="nombre" class="alumno__input" value="{{ $alumno->nombre }}" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Apellido Paterno</label>
        <input type="text" name="apellido_paterno" class="alumno__input" value="{{ $alumno->apellido_paterno }}" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Apellido Materno</label>
        <input type="text" name="apellido_materno" class="alumno__input" value="{{ $alumno->apellido_materno }}" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">DNI</label>
        <input type="text" name="dni" class="alumno__input" value="{{ $alumno->dni }}" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="alumno__input" value="{{ $alumno->fecha_nacimiento }}" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Género</label>
        <select name="genero" class="alumno__input">
            <option value="masculino" {{ $alumno->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ $alumno->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ $alumno->genero == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Correo</label>
        <input type="email" name="email" class="alumno__input" value="{{ $alumno->email }}">
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Teléfono</label>
        <input type="text" name="telefono" class="alumno__input" value="{{ $alumno->telefono }}">
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Dirección</label>
        <input type="text" name="direccion" class="alumno__input" value="{{ $alumno->direccion }}">
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Estado</label>
        <select name="estado" class="alumno__input">
            <option value="activo" {{ $alumno->estado == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $alumno->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <button class="alumno__button alumno__button--primary" type="submit">
        Actualizar
    </button>
</form>
