<form action="{{ route('docentes.save') }}" method="POST" class="form">
    @csrf
    <input type="hidden" name="id" value="{{ $docente->id }}">

    <!-- FILA 1: Nombre, Apellido Paterno -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Nombre</label>
            <input type="text" name="nombre" class="form__input" value="{{ $docente->nombre }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form__input" value="{{ $docente->apellido_paterno }}" required>
        </div>
    </div>

    <!-- FILA 2: Apellido Materno, DNI -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form__input" value="{{ $docente->apellido_materno }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">DNI</label>
            <input type="text" name="dni" class="form__input" value="{{ $docente->dni }}" required>
        </div>
    </div>

    <!-- FILA 3: Fecha de nacimiento, Género -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form__input" value="{{ $docente->fecha_nacimiento }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">Género</label>
            <select name="genero" class="form__input">
                <option value="masculino" {{ $docente->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $docente->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ $docente->genero == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
    </div>

    <!-- FILA 4: Correo, Teléfono -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Correo</label>
            <input type="email" name="email" class="form__input" value="{{ $docente->email }}">
        </div>

        <div class="form__group">
            <label class="form__label">Teléfono</label>
            <input type="text" name="telefono" class="form__input" value="{{ $docente->telefono }}">
        </div>
    </div>

    <!-- FILA 5: Dirección, Especialidad -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Dirección</label>
            <input type="text" name="direccion" class="form__input" value="{{ $docente->direccion }}">
        </div>

        <div class="form__group">
            <label class="form__label">Especialidad</label>
            <select name="especialidad" class="form__input">
                <option value="Matemáticas" {{ $docente->especialidad == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                <option value="Física" {{ $docente->especialidad == 'Física' ? 'selected' : '' }}>Física</option>
                <option value="Química" {{ $docente->especialidad == 'Química' ? 'selected' : '' }}>Química</option>
                <option value="Biología" {{ $docente->especialidad == 'Biología' ? 'selected' : '' }}>Biología</option>
                <option value="Lengua y Literatura" {{ $docente->especialidad == 'Lengua y Literatura' ? 'selected' : '' }}>Lengua y Literatura</option>
                <option value="Historia" {{ $docente->especialidad == 'Historia' ? 'selected' : '' }}>Historia</option>
                <option value="Inglés" {{ $docente->especialidad == 'Inglés' ? 'selected' : '' }}>Inglés</option>
            </select>
        </div>
    </div>

    <!-- FILA 6: Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input">
                <option value="activo" {{ $docente->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $docente->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <!-- Botón actualizar -->
    <button type="submit" class="form__button form__button--primary">
        Actualizar
    </button>
</form>
