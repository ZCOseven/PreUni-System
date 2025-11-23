<form action="{{ route('matriculas.save') }}" method="POST" class="form">
    @csrf
    @if(isset($matricula))
        <input type="hidden" name="id" value="{{ $matricula->id }}">
    @endif

    <!-- FILA 1: Alumno y Periodo -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Alumno</label>
            <select name="alumno_id" class="form__input" required>
                <option value="">Seleccionar alumno</option>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id }}"
                        {{ old('alumno_id', $matricula->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}>
                        {{ $alumno->nombreCompleto() ?? $alumno->nombre.' '.$alumno->apellido_paterno }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form__group">
            <label class="form__label">Periodo</label>
            <select name="periodo" class="form__input" required>
                <option value="">Seleccionar periodo</option>
                @php
                    $periodos = ['2025-I','2025-II','2026-I','2026-II'];
                @endphp
                @foreach($periodos as $periodo)
                    <option value="{{ $periodo }}"
                        {{ old('periodo', $matricula->periodo ?? '') == $periodo ? 'selected' : '' }}>
                        {{ $periodo }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- FILA 2: Asignaturas (múltiples select) -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Asignaturas</label>
            <select name="asignaturas[]" class="form__input" multiple required>
                @foreach($asignaturas as $asig)
                    <option value="{{ $asig->id }}"
                        {{ isset($matricula) && in_array($asig->id, $asignaturas_ids ?? []) ? 'selected' : '' }}>
                        {{ $asig->curso->nombre ?? 'Curso' }} - {{ $asig->docente->nombre ?? 'Docente' }}
                    </option>
                @endforeach
            </select>
            <small>Mantén presionada la tecla Ctrl o Cmd para seleccionar varias asignaturas.</small>
        </div>
    </div>

    <!-- FILA 3: Fecha de Matrícula y Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Fecha de Matrícula</label>
            <input type="date" name="fecha_matricula" class="form__input"
                value="{{ old('fecha_matricula', $matricula->fecha_matricula ?? date('Y-m-d')) }}" required>
        </div>

        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input" required>
                <option value="activo" {{ (old('estado', $matricula->estado ?? '') == 'activo') ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ (old('estado', $matricula->estado ?? '') == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Observaciones</label>
            <textarea name="observaciones" class="form__input" rows="3">{{ old('observaciones', $matricula->observaciones ?? '') }}</textarea>
        </div>
    </div>

    <!-- Botón Guardar -->
    <button type="submit" class="form__button form__button--primary">Guardar</button>
</form>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // No hay checkboxes como en asignaturas, pero si necesitas algo similar se puede agregar
});
</script>
@endpush
