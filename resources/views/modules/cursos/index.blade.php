@extends('layouts.app')
@section('title', 'Cursos')

<style>
    /* ================================
   ESTILOS BEM PARA LA VISTA CURSOS
   ================================ */

    /* CONTENEDOR GENERAL */
    .cursos {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* HEADER */
    .cursos__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .cursos__title {
        font-size: 24px;
        font-weight: bold;
    }

    /* BOTÓN PRINCIPAL */
    .btn {
        padding: 8px 14px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn--primary {
        background-color: #007bff;
        color: white;
    }

    .btn--info {
        background-color: #17a2b8;
        color: white;
    }

    .btn--warning {
        background-color: #ffc107;
        color: black;
    }

    .btn--danger {
        background-color: #dc3545;
        color: white;
    }

    /* TABLA */
    .cursos__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .cursos__table th {
        background: #222;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .cursos__table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .cursos__table tr:hover {
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

    /* MODAL */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal--active {
        display: flex;
    }

    .modal__content {
        width: 600px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        animation: fadeIn .3s ease;
    }

    .modal__header {
        background: #222;
        color: white;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal__title {
        font-size: 18px;
        font-weight: bold;
    }

    .modal__close {
        color: white;
        cursor: pointer;
        font-size: 22px;
    }

    .modal__body {
        padding: 20px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
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

    /* ===============================
   FORMULARIOS BEM
   =============================== */

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
        /* Para adaptarse a pantallas pequeñas */
    }

    .form__group {
        display: flex;
        flex-direction: column;
        flex: 1;
        /* Cada grupo ocupa el mismo ancho por fila */
        min-width: 150px;
        /* Ancho mínimo para inputs */
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
</style>

@section('content')

<div class="cursos">

    <!-- HEADER -->
    <div class="cursos__header">
        <h2 class="cursos__title">Gestión de Cursos</h2>

        <a style="text-decoration: none;" class="btn btn--info" href="{{ route('admin.dashboard') }}">Volver</a>

        <button class="btn btn--primary" id="btnAgregarCurso">
            Agregar Curso
        </button>
    </div>

    <!-- INPUT DE BÚSQUEDA -->
    <input type="text" class="cursos__search" name="buscador" id="buscador" placeholder="Buscar Curso . . . .">

    <!-- TABLA -->
    <table class="cursos__table">
        <thead>
            <tr>
                <th>Nombre del curso</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($cursos as $curso)
            <tr class="registro">
                <td>{{ $curso->nombre }}</td>
                <td>{{ $curso->descripcion ?? '---' }}</td>

                <td>
                    @if($curso->estado === 'activo')
                    <span class="badge badge--success">Activo</span>
                    @else
                    <span class="badge badge--secondary">Inactivo</span>
                    @endif
                </td>

                <td style="text-align:center">

                    <button class="btn btn--warning js-editar" data-id="{{ $curso->id }}">
                        Editar
                    </button>

                    <form action="{{ route('cursos.destroy', $curso->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('¿Seguro que deseas eliminar este curso?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn--danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding:20px; text-align: center;">
                    No hay cursos registrados.
                </td>
            </tr>
            @endforelse

            <!-- FILA PARA CUANDO NO HAY RESULTADOS EN LA BÚSQUEDA -->
            <tr id="no-result" style="display:none;">
                <td colspan="4" style="padding:20px; text-align: center;">
                    No se encontraron resultados para la búsqueda.
                </td>
            </tr>
        </tbody>
    </table>

</div>

<!-- MODAL (VACÍO — se llena con JS) -->
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