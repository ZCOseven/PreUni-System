@extends('layouts.app')
@section('title', 'Módulo Docentes')

@section('content')


<!-- TOOLBAR -->
<div class="module__toolbar">

    <div class="module__search-wrapper">
        <span class="module__icon-search material-symbols-outlined">search</span>
        <input type="text" class="module__search" name="search" id="search" placeholder="Buscar Docente . . .">
    </div>

    <button class="module__btn-add" id="btnAgregarDocente">
        <span class="material-symbols-outlined module__btn-icon">
            person_add
        </span>
        Añadir Docente
    </button>
</div>

<!-- TABLA -->
<div class="tabla">

    {{-- HEADER --}}
    <div class="tabla__header">
        <div class="tabla__row tabla__row--header">
            <div class="tabla__cell">Nombre completo</div>
            <div class="tabla__cell">DNI</div>
            <div class="tabla__cell">Correo</div>
            <div class="tabla__cell">Estado</div>
            <div class="tabla__cell">Teléfono</div>
            <div class="tabla__cell tabla__cell--center">Opciones</div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="tabla__body">
        @forelse($docentes as $docente)

        <div class="tabla__row registro">
            <div class="tabla__cell">
                {{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
            </div>

            <div class="tabla__cell">{{ $docente->dni }}</div>

            <div class="tabla__cell">{{ $docente->email ?? '---' }}</div>

            <div class="tabla__cell">
                @if($docente->estado === 'activo')
                <span class="estado__activo">Activo</span>
                @else
                <span class="estado__inactivo">Inactivo</span>
                @endif
            </div>

            <div class="tabla__cell">{{ $docente->telefono ?? '---' }}</div>

            <div class="tabla__cell tabla__cell--center tabla__options">
                <button class="btn--info js-ver" data-id="{{ $docente->id }}">
                    <span class="option-icon material-symbols-outlined">info</span>
                </button>

                <button class="btn--warning js-editar" data-id="{{ $docente->id }}">
                    <span class="option-icon material-symbols-outlined">edit</span>
                </button>

                <form action="{{ route('docentes.destroy', $docente->id) }}"
                    method="POST"
                    class="tabla__delete-form"
                    onsubmit="event.stopPropagation(); return confirm('¿Seguro?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn--danger">
                        <span class="option-icon material-symbols-outlined">delete</span>
                    </button>
                </form>

                <button class="btn js-cursos" data-id="{{ $docente->id }}">Cursos asignados</button>
            </div>
        </div>

        @empty

        <div class="tabla__row">
            <div class="tabla__cell tabla__cell--empty">
                No hay docentes registrados.
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

<!-- MODAL -->
<div class="modal" id="docente-modal">
    <div class="modal__content">

        <div class="modal__header">
            <h5 class="modal__title" id="docente-modal-title">Docente</h5>
            <span class="modal__close" id="docente-modal-close">&times;</span>
        </div>

        <div class="modal__body" id="docente-modal-content">
            <!-- Se carga desde AJAX -->
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/docentes.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush