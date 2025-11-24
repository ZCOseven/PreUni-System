@extends('layouts.app')
@section('title', 'Módulo Asignaturas')


@section('content')

<!-- TOOLBAR -->
<div class="module__toolbar">

    <div class="module__search-wrapper">
        <span class="module__icon-search material-symbols-outlined">search</span>
        <input type="text" class="module__search" name="search" id="search" placeholder="Buscar Asignatura . . .">
    </div>

    <button class="module__btn-add" id="btnAgregarAsignatura">
        <span class="material-symbols-outlined module__btn-icon">
            library_add
        </span>
        Añadir Asignatura
    </button>
</div>

<!-- TABLA GLOBAL -->
<div class="tabla">

    {{-- HEADER --}}
    <div class="tabla__header">
        <div class="tabla__row tabla__row--asignatura tabla__row--header">
            <div class="tabla__cell">Curso</div>
            <div class="tabla__cell">Docente</div>
            <div class="tabla__cell">Periodo</div>
            <div class="tabla__cell">Horario</div>
            <div class="tabla__cell">Aula</div>
            <div class="tabla__cell">Estado</div>
            <div class="tabla__cell tabla__cell--center">Opciones</div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="tabla__body">

        @forelse($asignaturas as $asignatura)

        <div class="tabla__row tabla__row--asignatura registro">

            <!-- CURSO -->
            <div class="tabla__cell">
                {{ $asignatura->curso->nombre ?? 'Curso deshabilitado' }}
            </div>

            <!-- DOCENTE -->
            <div class="tabla__cell">
                @if($asignatura->docente && $asignatura->docente->estado === 'activo')

                {{ $asignatura->docente->codigo ? $asignatura->docente->codigo . ' - ' : '' }}
                {{ $asignatura->docente->nombre }}
                {{ $asignatura->docente->apellido_paterno }}
                {{ $asignatura->docente->apellido_materno }}

                @else
                <span class="texto__alerta">
                    Docente deshabilitado – contactar soporte
                </span>
                @endif
            </div>

            <!-- PERIODO -->
            <div class="tabla__cell">
                {{ $asignatura->periodo }}
            </div>

            <!-- HORARIO -->
            <div class="tabla__cell">
                {{ $asignatura->horarioFormateado() ?? '---' }}
            </div>

            <!-- AULA -->
            <div class="tabla__cell">
                {{ $asignatura->aula }}
            </div>

            <!-- ESTADO -->
            <div class="tabla__cell">
                @if($asignatura->estado === 'activo')
                <span class="estado__activo">Activo</span>
                @else
                <span class="estado__inactivo">Inactivo</span>
                @endif
            </div>

            <!-- OPCIONES -->
            <div class="tabla__cell tabla__cell--center tabla__options">

                <button class="btn--info js-ver" data-id="{{ $asignatura->id }}">
                    <span class="option-icon material-symbols-outlined">info</span>
                </button>

                <button class="btn--warning js-editar" data-id="{{ $asignatura->id }}">
                    <span class="option-icon material-symbols-outlined">edit</span>
                </button>

                <form action="{{ route('asignaturas.destroy', $asignatura->id) }}"
                    method="POST"
                    class="tabla__delete-form"
                    onsubmit="event.stopPropagation(); return confirm('¿Seguro?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn--danger">
                        <span class="option-icon material-symbols-outlined">delete</span>
                    </button>
                </form>

            </div>

        </div>

        @empty

        <div class="tabla__row">
            <div class="tabla__cell tabla__cell--empty">
                No hay asignaturas registradas.
            </div>
        </div>

        @endforelse

        {{-- NO RESULTADOS --}}
        <div class="tabla__row" id="no-result" style="display:none;">
            <div class="tabla__cell tabla__cell--empty">
                No se encontraron resultados para la búsqueda.
            </div>
        </div>

    </div>
</div>

<!-- MODAL (VACÍO — se llena con JS) -->
<div class="modal" id="asignatura-modal">
    <div class="modal__content">

        <div class="modal__header">
            <h5 class="modal__title" id="asignatura-modal-title">Asignatura</h5>
            <span class="modal__close" id="asignatura-modal-close">&times;</span>
        </div>

        <div class="modal__body" id="asignatura-modal-content">
            <!-- Se carga desde AJAX -->
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/asignaturas.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush