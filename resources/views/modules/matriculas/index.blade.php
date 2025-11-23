@extends('layouts.app')
@section('title', 'Matrículas')

<style>
    /* ================================
   ESTILOS BEM PARA LA VISTA MATRICULAS
   ================================ */

    /* CONTENEDOR GENERAL */
    .matriculas {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* HEADER */
    .matriculas__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .matriculas__title {
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
    .matriculas__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .matriculas__table th {
        background: #222;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .matriculas__table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .matriculas__table tr:hover {
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

    .matricula__form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .matricula__group {
        display: flex;
        flex-direction: column;
    }

    .matricula__label {
        font-size: 0.9rem;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .matricula__input {
        padding: 8px 10px;
        border: 1px solid #d1d1d1;
        border-radius: 4px;
    }

    .matricula__button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .matricula__button--primary {
        background-color: #007bff;
        color: white;
    }

    .matricula__detalle {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }

    .matricula__detail-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 6px;
    }

    .matricula__detail-label {
        font-weight: bold;
        color: #444;
    }

    .matricula__tag {
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-size: 0.8rem;
    }

    .matricula__tag--success {
        background-color: #28a745;
    }

    .matricula__tag--danger {
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
</style>

@section('content')

<div class="matriculas">

    <!-- HEADER -->
    <div class="matriculas__header">
        <h2 class="matriculas__title">Gestión de Matrículas</h2>

        <a style="text-decoration: none;" class="btn btn--info" href="{{ route('admin.dashboard') }}">Volver</a>

        <button class="btn btn--primary" id="btnAgregarMatricula">
            Agregar Matrícula
        </button>
    </div>

    <!-- INPUT DE BÚSQUEDA -->
    <input type="text" class="matriculas__search" name="buscador" id="buscador" placeholder="Buscar Matrícula . . . .">

    <!-- TABLA -->
    <table class="matriculas__table">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Periodo</th>
                <th>Estado</th>
                <th>Asignaturas</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($matriculas as $matricula)
            <tr class="registro">
                <td>{{ $matricula->alumno->nombreCompleto() ?? 'Alumno eliminado' }}</td>
                <td>{{ $matricula->periodo }}</td>
                <td>
                    @if($matricula->estado === 'activo')
                    <span class="badge badge--success">Activo</span>
                    @else
                    <span class="badge badge--secondary">Inactivo</span>
                    @endif
                </td>
                <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    @if($matricula->asignaturas && count($matricula->asignaturas) > 0)
                        {{ implode(', ', $matricula->asignaturas->pluck('curso.nombre')->toArray()) }}
                        @else
                        ---
                        @endif
                </td>


                <td style="text-align:center">

                    <button class="btn btn--info js-ver" data-id="{{ $matricula->id }}">
                        Ver
                    </button>

                    <button class="btn btn--warning js-editar" data-id="{{ $matricula->id }}">
                        Editar
                    </button>

                    <form action="{{ route('matriculas.destroy', $matricula->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('¿Seguro que deseas eliminar esta matrícula?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn--danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:20px; text-align: center;">
                    No hay matrículas registradas.
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
<div class="modal" id="matricula-modal">
    <div class="modal__content">

        <div class="modal__header">
            <h5 class="modal__title" id="matricula-modal-title">Matrícula</h5>
            <span class="modal__close" id="matricula-modal-close">&times;</span>
        </div>

        <div class="modal__body" id="matricula-modal-content">
            <!-- Se carga desde AJAX -->
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/matriculas.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush