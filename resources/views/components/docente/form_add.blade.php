<form action="{{ route('docentes.save') }}" method="POST" class="form">
    @csrf
    @if(isset($docente))
        <input type="hidden" name="id" value="{{ $docente->id }}">
    @endif

    <!-- FILA 1: Nombre -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Nombre</label>
            <input type="text" name="nombre" class="form__input" 
                placeholder="Ingrese el nombre" 
                value="{{ old('nombre', $docente->nombre ?? '') }}" required>
        </div>
    </div>
    
    <!-- FILA 2: Apellidos -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form__input" 
                   placeholder="Ingrese el apellido paterno"
                   value="{{ old('apellido_paterno', $docente->apellido_paterno ?? '') }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form__input" 
                   placeholder="Ingrese el apellido materno"
                   value="{{ old('apellido_materno', $docente->apellido_materno ?? '') }}" required>
        </div>
    </div>

    <!-- FILA 3: DNI -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">DNI</label>
            <input type="text" name="dni" class="form__input" 
                   placeholder="Ingrese el DNI"
                   value="{{ old('dni', $docente->dni ?? '') }}" required>
        </div>
    </div>
    
    <!-- FILA 4: Fecha de nacimiento y Género -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form__input" 
                   value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento ?? '') }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">Género</label>
            <select name="genero" class="form__input" required>
                <option value="" disabled {{ !isset($docente) ? 'selected' : '' }}>Seleccionar Género</option>
                <option value="masculino" {{ (old('genero', $docente->genero ?? '') == 'masculino') ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ (old('genero', $docente->genero ?? '') == 'femenino') ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ (old('genero', $docente->genero ?? '') == 'otro') ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
    </div>

    <!-- FILA 5: Correo y Teléfono -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Correo</label>
            <input type="email" name="email" class="form__input" 
                   placeholder="Ingrese el correo"
                   value="{{ old('email', $docente->email ?? '') }}">
        </div>

        <div class="form__group">
            <label class="form__label">Teléfono</label>
            <input type="text" name="telefono" class="form__input" 
                   placeholder="Ingrese el teléfono"
                   value="{{ old('telefono', $docente->telefono ?? '') }}">
        </div>
    </div>

    <!-- FILA 6: Dirección y Especialidad -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Dirección</label>
            <input type="text" name="direccion" class="form__input" 
                   placeholder="Ingrese la dirección"
                   value="{{ old('direccion', $docente->direccion ?? '') }}">
        </div>

        <div class="form__group">
            <label class="form__label">Especialidad</label>
            <select name="especialidad" class="form__input" required>
                <option value="" disabled {{ !isset($docente) ? 'selected' : '' }}>Seleccionar Especialidad</option>
                @php
                    $opciones = ['Matemáticas','Física','Química','Biología','Historia','Lengua','Educación Física'];
                @endphp
                @foreach($opciones as $opcion)
                    <option value="{{ $opcion }}" {{ (old('especialidad', $docente->especialidad ?? '') == $opcion) ? 'selected' : '' }}>
                        {{ $opcion }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- FILA 7: Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input" required>
                <option value="" disabled {{ !isset($docente) ? 'selected' : '' }}>Seleccionar Estado</option>
                <option value="activo" {{ (old('estado', $docente->estado ?? '') == 'activo') ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ (old('estado', $docente->estado ?? '') == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <!-- Botón Guardar -->
    <button type="submit" class="form__button form__button--primary">
        Guardar
    </button>
</form>
