<form action="{{ route('asignaturas.save') }}" method="POST" class="form">
    @csrf
    @if(isset($asignatura))
        <input type="hidden" name="id" value="{{ $asignatura->id }}">
    @endif

    <!-- FILA 1: Curso y Docente -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Curso</label>
            <select name="curso_id" class="form__input" required>
                <option value="">Seleccionar curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}"
                        {{ old('curso_id', $asignatura->curso_id ?? '') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form__group">
            <label class="form__label">Docente</label>
            <select name="docente_id" class="form__input" required>
                <option value="">Seleccionar docente</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}"
                        {{ old('docente_id', $asignatura->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                        {{ $docente->codigo ? $docente->codigo . ' - ' : '' }}{{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- FILA 2: Periodo y Aula -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Periodo</label>
            <select name="periodo" class="form__input" required>
                <option value="">Seleccionar periodo</option>
                @foreach($periodos as $periodo)
                    <option value="{{ $periodo }}"
                        {{ old('periodo', $asignatura->periodo ?? '') == $periodo ? 'selected' : '' }}>
                        {{ $periodo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form__group">
            <label class="form__label">Aula</label>
            <select name="aula" class="form__input" required>
                <option value="">Seleccionar aula</option>
                @foreach($aulas as $aula)
                    <option value="{{ $aula }}"
                        {{ old('aula', $asignatura->aula ?? '') == $aula ? 'selected' : '' }}>
                        {{ $aula }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- FILA 3: Horario -->
<div class="form__row form__multi-dias">
    <label class="form__label">Horario</label><br>

    @php
        $diasSemana = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
        $horarioActual = $asignatura->horario ?? [];
    @endphp

    @foreach($diasSemana as $dia)
        @php
            $checked = false;
            $horaInicio = '';
            $horaFin = '';

            if(is_array($horarioActual)) {
                foreach($horarioActual as $h) {
                    if(strtolower($h['dia'] ?? '') == strtolower($dia)) {
                        $checked = true;
                        $horaInicio = $h['inicio'] ?? '';
                        $horaFin = $h['fin'] ?? '';
                    }
                }
            }
        @endphp

        <div class="form__dia">
            <!-- CORREGIDO: ahora se envia dentro de horario[] -->
            <input type="checkbox" 
                name="horario[dias][]" 
                value="{{ $dia }}" 
                id="dia-{{ $dia }}" 
                {{ $checked ? 'checked' : '' }}>

            <label for="dia-{{ $dia }}">{{ ucfirst($dia) }}</label>

            <!-- CORREGIDO: formato esperado por el controlador -->
            <input type="time" 
                name="horario[hora_inicio_{{ $dia }}]" 
                value="{{ old('hora_inicio_'.$dia, $horaInicio) }}" 
                class="form__input" 
                {{ $checked ? '' : 'disabled' }}>

            <input type="time" 
                name="horario[hora_fin_{{ $dia }}]" 
                value="{{ old('hora_fin_'.$dia, $horaFin) }}" 
                class="form__input" 
                {{ $checked ? '' : 'disabled' }}>
        </div>
    @endforeach
</div>

    <!-- FILA 4: Estado -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Estado</label>
            <select name="estado" class="form__input" required>
                <option value="activo" {{ (old('estado', $asignatura->estado ?? '') == 'activo') ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ (old('estado', $asignatura->estado ?? '') == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
    </div>

    <button type="submit" class="form__button form__button--primary">Guardar</button>
</form>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.form__multi-dias input[type=checkbox]').forEach(cb => {
        cb.addEventListener('change', function() {
            const parent = this.closest('.form__dia');
            parent.querySelectorAll('input[type=time]').forEach(input => {
                input.disabled = !this.checked;
                if(!this.checked) input.value = '';
            });
        });
    });
});
</script>
@endpush
