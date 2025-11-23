<form action="{{ route('alumnos.save') }}" method="POST" class="alumno__form">
    @csrf

    <div class="alumno__group">
        <label class="alumno__label">Nombre</label>
        <input type="text" name="nombre" class="alumno__input" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Apellido Paterno</label>
        <input type="text" name="apellido_paterno" class="alumno__input" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Apellido Materno</label>
        <input type="text" name="apellido_materno" class="alumno__input" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">DNI</label>
        <input type="text" name="dni" class="alumno__input" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="alumno__input" required>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Género</label>
        <select name="genero" class="alumno__input">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Correo</label>
        <input type="email" name="email" class="alumno__input">
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Teléfono</label>
        <input type="text" name="telefono" class="alumno__input">
    </div>

    <div class="alumno__group">
        <label class="alumno__label">Dirección</label>
        <input type="text" name="direccion" class="alumno__input">
    </div>

    <button class="alumno__button alumno__button--primary" type="submit">
        Guardar
    </button>
</form>
