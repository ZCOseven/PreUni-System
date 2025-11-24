@extends('layouts.app')
@section('title', 'Módulo Matrículas')

@section('content')

    <div class="module__toolbar">

        <div class="module__search-wrapper">
            <span class="module__icon-search material-symbols-outlined">search</span>
            <input type="text" class="module__search" name="buscador" id="buscador" placeholder="Buscar Matrícula . . .">
        </div>

        <button class="module__btn-add" id="btnAgregarMatricula">
            <span class="material-symbols-outlined module__btn-icon">
                post_add
            </span>
            Agregar Matrícula
        </button>
    </div>

    <div class="tabla">

        {{-- HEADER --}}
        <div class="tabla__header">
            <div class="tabla__row tabla__row--matriculas tabla__row--header">
                <div class="tabla__cell">Alumno</div>
                <div class="tabla__cell">Periodo</div>
                <div class="tabla__cell">Estado</div>
                <div class="tabla__cell">Asignaturas</div>
                <div class="tabla__cell tabla__cell--center">Opciones</div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="tabla__body">

            @forelse ($matriculas as $matricula)

                <div class="tabla__row tabla__row--matriculas registro">

                    <div class="tabla__cell">
                        @if($matricula->alumno)
                            {{ $matricula->alumno->nombreCompleto() }}
                        @else
                            <span class="texto__alerta">Sin alumno</span>
                        @endif
                    </div>

                    <div class="tabla__cell">
                        {{ $matricula->periodo }}
                    </div>

                    <div class="tabla__cell">
                        @if($matricula->estado === 'activo')
                            <span class="estado__activo">Activo</span>
                        @else
                            <span class="estado__inactivo">Inactivo</span>
                        @endif
                    </div>

                    <div class="tabla__cell tabla__cell--truncate">
                        @if($matricula->asignaturas && count($matricula->asignaturas) > 0)
                            <span>
                                {{ implode(', ', $matricula->asignaturas->pluck('curso.nombre')->toArray()) }}
                            </span>
                        @else
                            ---
                        @endif
                    </div>

                    <div class="tabla__cell tabla__cell--center tabla__options">

                        <button class="btn--info js-ver" data-id="{{ $matricula->id }}">
                            <span class="option-icon material-symbols-outlined">info</span>
                        </button>

                        <button class="btn--warning js-editar" data-id="{{ $matricula->id }}">
                            <span class="option-icon material-symbols-outlined">edit</span>
                        </button>

                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST"
                            class="tabla__delete-form"
                            onsubmit="event.stopPropagation(); return confirm('¿Seguro que deseas eliminar esta matrícula?')">

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
                        No hay matrículas registradas.
                    </div>
                </div>

            @endforelse

            {{-- NO RESULTADOS (BÚSQUEDA) --}}
            <div class="tabla__row" id="no-result" style="display:none;">
                <div class="tabla__cell tabla__cell--empty">
                    No se encontraron resultados para la búsqueda.
                </div>
            </div>

        </div>
    </div>

    <div class="modal" id="matricula-modal">
        <div class="modal__content">

            <div class="modal__header">
                <h5 class="modal__title" id="matricula-modal-title">Matrícula</h5>
                <span class="modal__close" id="matricula-modal-close">&times;</span>
            </div>

            <div class="modal__body" id="matricula-modal-content">
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/matriculas.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>
@endpush