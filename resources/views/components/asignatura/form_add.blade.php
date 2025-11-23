<form action="{{ route('asignaturas.save') }}" method="POST" class="form">
    @csrf
    @if(isset($asignatura))
    <!-- <input type="hidden" name="id" value="{{ $asignatura->id }}"> -->
    @endif

    <!-- FILA 1: Curso y Docente -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Curso</label>
            <select name="curso_id" class="form__input" required>
                <option value="">Seleccionar curso</option>

                @foreach($cursos as $curso)
                <option value="{{ $curso->id }}"
                    {{ (old('curso_id', $asignatura->curso_id ?? '') == $curso->id) ? 'selected' : '' }}>
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
                    {{ (old('docente_id', $asignatura->docente_id ?? '') == $docente->id) ? 'selected' : '' }}>
                    {{ $docente->codigo ?? '' }} {{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
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
                @php
                $periodos = ['2025-1','2025-2','2026-1','2026-2'];
                @endphp
                @foreach($periodos as $periodo)
                <option value="{{ $periodo }}"
                    {{ (old('periodo', $asignatura->periodo ?? '') == $periodo) ? 'selected' : '' }}>
                    {{ $periodo }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form__group">
            <label class="form__label">Aula</label>
            <select name="aula" class="form__input" required>
                <option value="">Seleccionar aula</option>
                @php
                $aulas = ['AULA-101','AULA-102','AULA-103','LAB-201','LAB-202'];
                @endphp
                @foreach($aulas as $aula)
                <option value="{{ $aula }}"
                    {{ (old('aula', $asignatura->aula ?? '') == $aula) ? 'selected' : '' }}>
                    {{ $aula }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- FILA 3: Horario -->
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Horario</label>
            <div class="form__multi-dias">
                @php
                $diasSemana = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
                $horarios = old('horario', $asignatura->horario ?? []);
                @endphp
                @foreach($diasSemana as $dia)
                @php
                $checked = false;
                $hora_inicio = '';
                $hora_fin = '';
                if(is_array($horarios) && isset($horarios['dias']) && in_array($dia, $horarios['dias'])) {
                $checked = true;
                $hora_inicio = $horarios['hora_inicio'] ?? '';
                $hora_fin = $horarios['hora_fin'] ?? '';
                } elseif(is_array($horarios) && isset($horarios[0])) {
                // caso de horarios diferentes por día
                foreach($horarios as $h) {
                if(strtolower($h['dia']) == strtolower($dia)) {
                $checked = true;
                $hora_inicio = $h['inicio'] ?? '';
                $hora_fin = $h['fin'] ?? '';
                }
                }
                }
                @endphp
                <div class="form__dia">
                    <label>
                        <input type="checkbox" name="horario[dias][]" value="{{ $dia }}" {{ $checked ? 'checked' : '' }}>
                        {{ ucfirst($dia) }}
                    </label>
                    <input type="time" name="horario[hora_inicio_{{ $dia }}]" class="form__input" value="{{ $hora_inicio }}" {{ $checked ? '' : 'disabled' }}>
                    <input type="time" name="horario[hora_fin_{{ $dia }}]" class="form__input" value="{{ $hora_fin }}" {{ $checked ? '' : 'disabled' }}>
                </div>
                @endforeach
            </div>
            <small>Selecciona los días y ajusta la hora de inicio y fin para cada día.</small>
        </div>
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

    <!-- Botón Guardar -->
    <button type="submit" class="form__button form__button--primary">
        Guardar
    </button>
</form>