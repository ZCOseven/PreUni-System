<form action="{{ route('cursos.save') }}" method="POST" class="form">
    @csrf
    <input type="hidden" name="id" value="{{ $curso->id }}">

    <!-- FILA 1: Nombre -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Nombre del curso</label>
            <input type="text" name="nombre" class="form__input" value="{{ $curso->nombre }}" required>
        </div>
    </div>

    <!-- FILA 2: Descripción -->
    <div class="form__row">
        <div class="form__group" style="flex:1;">
            <label class="form__label">Descripción</label>
            <textarea name="descripcion" class="form__input" rows="3">{{ $curso->descripcion }}</textarea>
        </div>
    </div>

    <!-- FILA 3: Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input" required>
                <option value="activo" {{ $curso->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $curso->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <!-- Botón actualizar -->
    <button type="submit" class="form__button form__button--primary">
        Actualizar
    </button>
</form>
