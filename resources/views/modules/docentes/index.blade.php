@extends('layouts.app')
@section('title', 'Docentes')

@section('content')

<style>
    /* ================================
   ESTILOS BEM PARA LA VISTA DOCENTES
   ================================ */

    /* CONTENEDOR GENERAL */
    .docentes {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* HEADER */
    .docentes__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .docentes__title {
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
    .docentes__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .docentes__table th {
        background: #222;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .docentes__table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .docentes__table tr:hover {
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

    .docente__form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .docente__group {
        display: flex;
        flex-direction: column;
    }

    .docente__label {
        font-size: 0.9rem;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .docente__input {
        padding: 8px 10px;
        border: 1px solid #d1d1d1;
        border-radius: 4px;
    }

    .docente__button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .docente__button--primary {
        background-color: #007bff;
        color: white;
    }

    .docente__detalle {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }

    .docente__detail-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 6px;
    }

    .docente__detail-label {
        font-weight: bold;
        color: #444;
    }

    .docente__tag {
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-size: 0.8rem;
    }

    .docente__tag--success {
        background-color: #28a745;
    }

    .docente__tag--danger {
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



    .docente-cursos {
        padding: 1rem;
    }

    .docente-cursos__title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .docente-cursos__empty {
        font-style: italic;
        color: #555;
    }

    .docente-cursos__table {
        width: 100%;
        border-collapse: collapse;
    }

    .docente-cursos__table th,
    .docente-cursos__table td {
        border: 1px solid #ccc;
        padding: 0.5rem;
        text-align: left;
    }

    .docente-cursos__estado--success {
        color: #2b8a3e;
        font-weight: bold;
    }

    .docente-cursos__estado--danger {
        color: #d6336c;
        font-weight: bold;
    }
</style>

<div class="docentes">

    <!-- HEADER -->
    <div class="docentes__header">
        <h2 class="docentes__title">Gestión de Docentes</h2>

        <a style="text-decoration: none;" class="btn btn--info" href="{{ route('admin.dashboard') }}">Volver</a>

        <button class="btn btn--primary" id="btnAgregarDocente">
            Agregar Docente
        </button>
    </div>

    <!-- INPUT DE BÚSQUEDA -->
    <input type="text" class="docentes__search" name="buscador" id="buscador" placeholder="Buscar Docente . . . .">

    <!-- TABLA -->
    <table class="docentes__table">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>DNI</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Teléfono</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($docentes as $docente)
            <tr class="registro">
                <td>
                    {{ $docente->nombre }}
                    {{ $docente->apellido_paterno }}
                    {{ $docente->apellido_materno }}
                </td>

                <td>{{ $docente->dni }}</td>
                <td>{{ $docente->email ?? '---' }}</td>

                <td>
                    @if($docente->estado === 'activo')
                    <span class="badge badge--success">Activo</span>
                    @else
                    <span class="badge badge--secondary">Inactivo</span>
                    @endif
                </td>

                <td>{{ $docente->telefono ?? '---' }}</td>

                <td style="text-align:center">

                    <button class="btn btn--info js-ver" data-id="{{ $docente->id }}">
                        Ver
                    </button>

                    <button class="btn btn--warning js-editar" data-id="{{ $docente->id }}">
                        Editar
                    </button>

                    <form action="{{ route('docentes.destroy', $docente->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('¿Seguro que deseas eliminar este docente?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn--danger">Eliminar</button>
                    </form>

                    <button class="btn js-cursos" data-id="{{ $docente->id }}">Cursos asignados</button>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:20px; text-align: center;">
                    No hay docentes registrados.
                </td>
            </tr>
            @endforelse

            <!-- FILA PARA CUANDO NO HAY RESULTADOS EN LA BÚSQUEDA -->
            <tr id="no-result" style="display:none;">
                <td colspan="6" style="padding:20px; text-align: center;">
                    No se encontraron resultados para la búsqueda.
                </td>
            </tr>
        </tbody>
    </table>

</div>

<!-- MODAL (VACÍO — se llena con JS) -->
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