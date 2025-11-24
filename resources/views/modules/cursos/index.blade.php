@extends('layouts.app')
@section('title', 'Módulo Cursos')


@section('content')

<!-- TOOLBAR -->
<div class="module__toolbar">

    <div class="module__search-wrapper">
        <span class="module__icon-search material-symbols-outlined">search</span>
        <input type="text" class="module__search" name="search" id="search" placeholder="Buscar Curso . . .">
    </div>

    <button class="module__btn-add" id="btnAgregarCurso">
        <span class="material-symbols-outlined module__btn-icon">add</span>
        Añadir Curso
    </button>
</div>

<!-- TABLA -->
<div class="tabla">

    {{-- HEADER --}}
    <div class="tabla__header">
        <div class="tabla__row tabla__row--cursos tabla__row--header">
            <div class="tabla__cell">Nombre del curso</div>
            <div class="tabla__cell">Descripción</div>
            <div class="tabla__cell text-center">Estado</div>
            <div class="tabla__cell tabla__cell--center">Opciones</div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="tabla__body">
        @forelse($cursos as $curso)
        <div class="tabla__row tabla__row--cursos registro">
            <div class="tabla__cell">{{ $curso->nombre }}</div>
            <div class="tabla__cell">{{ $curso->descripcion ?: '---' }}</div>

            <div class="tabla__cell text-center">
                @if($curso->estado === 'activo')
                    <span class="estado__activo">Activo</span>
                @else
                    <span class="estado__inactivo">Inactivo</span>
                @endif
            </div>

            <div class="tabla__cell tabla__cell--center tabla__options">

                <button class="btn--warning js-editar" data-id="{{ $curso->id }}">
                    <span class="option-icon material-symbols-outlined">edit</span>
                </button>

                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="tabla__delete-form"
                    onsubmit="event.stopPropagation(); return confirm('¿Seguro que deseas eliminar este curso?')">
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
                No hay cursos registrados.
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
<div class="modal" id="curso-modal">
    <div class="modal__content">

        <div class="modal__header">
            <h5 class="modal__title" id="curso-modal-title">Curso</h5>
            <span class="modal__close" id="curso-modal-close">&times;</span>
        </div>

        <div class="modal__body" id="curso-modal-content">
            <!-- Se carga desde AJAX -->
        </div>

    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/cursos.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush