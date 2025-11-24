<form action="{{ route('alumnos.save') }}" method="POST" class="form">
    @csrf

    <!-- FILA 1: Nombre -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Nombre</label>
            <input type="text" name="nombre" class="form__input" value="{{ old('nombre') }}" placeholder="Ejem. Carmen Patricia" required>
        </div>
    </div>

    <!-- FILA 2: Apellido Paterno y Apellido Materno -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form__input" value="{{ old('apellido_paterno') }}" placeholder="Ejem. Armendáriz" required>
        </div>
        <div class="form__group">
            <label class="form__label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form__input" value="{{ old('apellido_materno') }}" placeholder="Ejem. Guerra" required>
        </div>
    </div>

    <!-- FILA 3: DNI -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">DNI</label>
            <input type="text" name="dni" class="form__input" value="{{ old('dni') }}" placeholder="Ejem. 73773295" required>
        </div>
    </div>

    <!-- FILA 4: Fecha de nacimiento y Género -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form__input" value="{{ old('fecha_nacimiento') }}" required>
        </div>
        <div class="form__group">
            <label class="form__label">Género</label>
            <select name="genero" class="form__input">
                <option value="">Seleccionar género</option>
                <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
    </div>

    <!-- FILA 5: Correo y Teléfono -->
    <div class="form__row">
        <!-- Input usuario -->
        <div class="form__group">
            <label class="form__label">Correo</label>
            <div class="c-email-concatenado">
                <input type="text" name="correo_usuario" class="form__input"
                    value="{{ old('correo_usuario') }}" placeholder="Ejem. patricia.armendariz" required>
                <select name="correo_dominio" class="form__input" required>
                    @php
                    $dominios = ['gmail.com','hotmail.com','yahoo.com','outlook.com'];
                    @endphp
                    @foreach($dominios as $dominio)
                    <option value="{{ $dominio }}" {{ (old('correo_dominio') == $dominio) ? 'selected' : '' }}>
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
            <input type="text" name="telefono" class="form__input" placeholder="Ejem. 999999999" value="{{ old('telefono') }}">
        </div>
    </div>

    <!-- FILA 6: Dirección -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Dirección</label>
            <input type="text" name="direccion" class="form__input" placeholder="Ejem. Av. 12 de octubre" value="{{ old('direccion') }}">
        </div>
    </div>

    <!-- Botón Guardar -->
    <button type="submit" class="form__button form__button--primary">
        Guardar
    </button>
</form>
