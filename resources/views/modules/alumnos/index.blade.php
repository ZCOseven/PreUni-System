@extends('layouts.app')
@section('title', 'Módulo Alumnos')

@section('content')

<style>
    /* TABLA */
    .alumnos__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .alumnos__table th {
        background: #222;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .alumnos__table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .alumnos__table tr:hover {
        background: #f5f5f5;
    }

    /* BADGES */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge--success {
        background: #28a745;
        color: white;
    }

    .badge--secondary {
        background: #6c757d;
        color: white;
    }

    

    /* ========== BLOQUE ALUMNO (BEM) ========== */

    .alumno__form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .alumno__group {
        display: flex;
        flex-direction: column;
    }

    .alumno__label {
        font-size: 0.9rem;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .alumno__input {
        padding: 8px 10px;
        border: 1px solid #d1d1d1;
        border-radius: 4px;
    }

    .alumno__button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .alumno__button--primary {
        background-color: #007bff;
        color: white;
    }

    .alumno__detalle {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }

    .alumno__detail-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 6px;
    }

    .alumno__detail-label {
        font-weight: bold;
        color: #444;
    }

    .alumno__tag {
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-size: 0.8rem;
    }

    .alumno__tag--success {
        background-color: #28a745;
    }

    .alumno__tag--danger {
        background-color: #dc3545;
    }
</style>


<style>
    .module__toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .module__search-wrapper {
        position: relative;
        display: inline-block;
    }

    .module__icon-search {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #1A5D94;
        pointer-events: none;
    }

    .module__search::placeholder {
        color: #1A5D94;
    }

    .module__search {
        outline: none;
        width: 340px;
        padding-left: 49px;
        height: 40px;
        color: #1A5D94;
        border-radius: 10px;
        border: 1px solid #1A5D94;
        font-size: 13px;
    }

    .module__btn-add {
        width: fit-content;
        padding: 10px 20px;
        border-radius: 10px;
        border: 1px solid #1A5D94;
        font-weight: 500;
        background-color: #1A5D94;
        color: #FFF;
        cursor: pointer;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* TOOLBAR */
    .module__toolbar {
        padding: 10px 0;
        flex-shrink: 0;
    }

    .tabla {
        flex: 1;

        display: flex;
        flex-direction: column;
        border-radius: 10px;
        gap: 10px;
        min-height: 0;
    }

    .tabla__header {
        position: sticky;
        top: 0;
        z-index: 20;
        flex-shrink: 0;
        background: #e0e6ec;
    }

    .tabla__header>.tabla__row {
        color: #414344;
    }

    .tabla__row--header {
        display: grid;
        grid-template-columns: 2fr 1fr 2fr 1fr 1fr 1.5fr;
        background: #e0e6ec !important;
        font-weight: bold;
    }

    .tabla__body {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 20px;
        overflow-y: auto;
        min-height: 0;

    }

    .tabla__body::-webkit-scrollbar {
        width: 0px;
    }

    .tabla__body {
        scrollbar-width: none;

    }

    .tabla__row {
        display: grid;
        grid-template-columns: 2fr 1fr 2fr 1fr 1fr 1.5fr;
        background: #f7f7f7;
        color: #222324;
        padding: 14px 30px;
        border-radius: 10px;
        align-items: center;
    }

    .tabla__cell {
        /* padding: 4px 8px; */
        font-size: 14px;
    }

    .tabla__cell--center {
        text-align: center;
        display: flex;
        gap: 5px;
        justify-content: center;
    }


    .tabla__cell--empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 20px;
        font-style: italic;
    }

    .registro>.tabla__cell {
        font-weight: 300;
    }

    .estado__activo {
        color: #16A34A;
        border-radius: 10px;
        background-color: #8AD1A4;
        font-weight: 500;
        padding: 10px;
    }

    .estado__inactivo {
        color: #DF3C3C;
        border-radius: 10px;
        background-color: #EF9D9D;
        font-weight: 500;
        padding: 10px;
    }

    .option-icon {
        pointer-events: none;
    }

    .btn--info {
        background-color: #8CADC9;
        color: #1A5D94;
        display: flex;
        align-items: center;
        padding: 7px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btn--warning {
        background-color: #FFD67F;
        color: #FFAF00;
        display: flex;
        align-items: center;
        padding: 7px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btn--danger {
        background-color: #D97F92;
        color: #B50027;
        display: flex;
        align-items: center;
        padding: 7px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .tabla__options {
        display: flex;
        gap: 10px;
    }

    .form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        font-family: Arial, sans-serif;
    }

    .form__row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .form__group {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 150px;
    }

    .form__label {
        font-size: 0.9rem;
        margin-bottom: 4px;
        font-weight: 600;
        color: #333;
    }

    .form__input {
        padding: 8px 10px;
        border: 1px solid #d1d1d1;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .form__button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .form__button--primary {
        background-color: #007bff;
        color: white;
    }

    .form__button--secondary {
        background-color: #6c757d;
        color: white;
    }

    /* Opcional: hover para inputs y botones */
    .form__input:focus {
        border-color: #007bff;
        outline: none;
    }

    .form__button:hover {
        opacity: 0.9;
    }

    .c-email-concatenado {
        display: flex;
        flex-direction: row;
        gap: 0;
        width: 100%;
    }

    .c-email-concatenado input {
        flex: 4;
    }

    .c-email-concatenado select {
        flex: 3;
    }

    .filtro {
        display: none;
    }

    .detail-list {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 6px;
    }

    .detail-label {
        font-weight: bold;
        color: #444;
    }

    .detail-value {
        color: #333;
        max-width: 400px;
    }

    .tag {
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-size: 0.8rem;
    }

    .tag--success {
        background-color: #28a745;
    }

    .tag--danger {
        background-color: #dc3545;
    }

    .detail-h1{
        font-family: 'Inter', sans-serif;
        color: #1A5D94;
        font-size: 20px;
        font-weight: 900;
    }

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .6);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal--visible {
        display: flex !important;
    }

    /* ================================
   LOADER PARA MODAL (BEM)
   ================================ */

    .modal-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 25px 0;
    }

    .modal-loader__circle {
        width: 40px;
        height: 40px;
        border: 3px solid transparent;
        border-top: 3px solid #3498db;
        border-right: 3px solid #3498db;
        border-radius: 50%;
        animation: modal-loader-spin 0.8s linear infinite;
    }

    @keyframes modal-loader-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>



<div class="module__toolbar">

    <div class="module__search-wrapper">
        <span class="module__icon-search material-symbols-outlined">search</span>
        <input type="text" class="module__search" name="search" id="search" placeholder="Buscar Alumno . . .">
    </div>

    <button class="module__btn-add" id="btnAgregarAlumno">
        <span class="material-symbols-outlined module__btn-icon">
            person_add
        </span>
        Añadir Alumno
    </button>
</div>

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
        @forelse($alumnos as $alumno)

        <div class="tabla__row registro">
            <div class="tabla__cell">
                {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}
            </div>

            <div class="tabla__cell">{{ $alumno->dni }}</div>

            <div class="tabla__cell">{{ $alumno->email ?? '---' }}</div>

            <div class="tabla__cell">
                @if($alumno->estado === 'activo')
                <span class="estado__activo">Activo</span>
                @else
                <span class="estado__inactivo">Inactivo</span>
                @endif
            </div>

            <div class="tabla__cell">{{ $alumno->telefono ?? '---' }}</div>

            <div class="tabla__cell tabla__cell--center tabla__options">
                <button class="btn--info js-ver" data-id="{{ $alumno->id }}"><span class="option-icon material-symbols-outlined">info</span></button>

                <button class="btn--warning js-editar" data-id="{{ $alumno->id }}"><span class="option-icon material-symbols-outlined">edit</span></button>

                <form action="{{ route('alumnos.destroy', $alumno->id) }}"
                    method="POST"
                    class="tabla__delete-form"
                    onsubmit="event.stopPropagation(); return confirm('¿Seguro?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn--danger"><span class="option-icon material-symbols-outlined">delete</span></button>
                </form>
            </div>
        </div>

        @empty

        <div class="tabla__row">
            <div class="tabla__cell tabla__cell--empty">
                No hay alumnos registrados.
            </div>
        </div>

        @endforelse

        {{-- NO RESULTADOS (se muestra/oculta vía JS) --}}
        <div class="tabla__row" id="no-result" style="display:none;">
            <div class="tabla__cell tabla__cell--empty">
                No se encontraron resultados para la búsqueda.
            </div>
        </div>
    </div>

</div>




<!-- MODAL (VACÍO — se llena con JS) -->
<div class="modal" id="alumno-modal">
    <div class="modal__content">

        <div class="modal__header">
            <h5 class="modal__title" id="alumno-modal-title">Alumno</h5>
            <span class="modal__close" id="alumno-modal-close">&times;</span>
        </div>

        <div class="modal__body" id="alumno-modal-content">
            <!-- Se carga desde AJAX -->
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/alumnos.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush