<form action="{{ route('alumnos.save') }}" method="POST" class="form">
    @csrf
    <input type="hidden" name="id" value="{{ $alumno->id }}">

    <!-- FILA 1: Nombre -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Nombre</label>
            <input type="text" name="nombre" class="form__input" value="{{ $alumno->nombre }}" required>
        </div>
    </div>

    <!-- FILA 2: Apellido Paterno y Apellido Materno -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form__input" value="{{ $alumno->apellido_paterno }}" required>
        </div>
        <div class="form__group">
            <label class="form__label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form__input" value="{{ $alumno->apellido_materno }}" required>
        </div>
    </div>

    <!-- FILA 3: DNI -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">DNI</label>
            <input type="text" name="dni" class="form__input" value="{{ $alumno->dni }}" required>
        </div>
    </div>

    <!-- FILA 4: Fecha de nacimiento y Género -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form__input" value="{{ $alumno->fecha_nacimiento }}" required>
        </div>
        <div class="form__group">
            <label class="form__label">Género</label>
            <select name="genero" class="form__input">
                <option value="masculino" {{ $alumno->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $alumno->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ $alumno->genero == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
    </div>

    @php
    $correoUsuario = '';
    $correoDominio = '';
    if(!empty($alumno->email) && strpos($alumno->email, '@') !== false){
        [$correoUsuario, $correoDominio] = explode('@', $alumno->email, 2);
    }
    $dominios = ['gmail.com','hotmail.com','yahoo.com','outlook.com'];
    @endphp

    <!-- FILA 5: Correo -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Correo</label>
            <div class="c-email-concatenado">
                <input type="text" name="correo_usuario" class="form__input"
                    value="{{ old('correo_usuario', $correoUsuario) }}" placeholder="Ejem. patricia.armendariz" required>
                <select name="correo_dominio" class="form__input" required>
                    @foreach($dominios as $dominio)
                        <option value="{{ $dominio }}" {{ (old('correo_dominio', $correoDominio) == $dominio) ? 'selected' : '' }}>
                            {{ '@'.$dominio }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Teléfono</label>
            <input type="text" name="telefono" class="form__input" value="{{ $alumno->telefono }}">
        </div>
    </div>

    <!-- FILA 6: Dirección y Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Dirección</label>
            <input type="text" name="direccion" class="form__input" value="{{ $alumno->direccion }}">
        </div>
        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input">
                <option value="activo" {{ $alumno->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $alumno->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <!-- Botón Actualizar -->
    <button type="submit" class="form__button form__button--primary">
        Actualizar
    </button>
</form>
