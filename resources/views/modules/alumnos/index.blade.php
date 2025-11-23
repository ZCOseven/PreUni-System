@extends('layouts.app')
@section('title', 'Alumnos')

@section('content')

<style>
    /* ================================
   ESTILOS BEM PARA LA VISTA ALUMNOS
   ================================ */

    /* CONTENEDOR GENERAL */
    .alumnos {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* HEADER */
    .alumnos__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .alumnos__title {
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
</style>



<div class="alumnos">

    <!-- HEADER -->
    <div class="alumnos__header">
        <h2 class="alumnos__title">Gestión de Alumnos</h2>

        <a style="text-decoration: none;" class="btn btn--info" href="{{ route('admin.dashboard') }}">Volver</a>

        <button class="btn btn--primary" id="btnAgregarAlumno">
            Agregar Alumno
        </button>
    </div>

    <!-- INPUT DE BÚSQUEDA -->
    <input type="text" class="alumnos__search" name="buscador" id="buscador" placeholder="Buscar Alumno . . . .">

    <!-- TABLA -->
    <table class="alumnos__table">
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
            @forelse ($alumnos as $alumno)
            <tr class="registro">
                <td>
                    {{ $alumno->nombre }}
                    {{ $alumno->apellido_paterno }}
                    {{ $alumno->apellido_materno }}
                </td>

                <td>{{ $alumno->dni }}</td>
                <td>{{ $alumno->email ?? '---' }}</td>
                
                <td>
                    @if($alumno->estado === 'activo')
                    <span class="badge badge--success">Activo</span>
                    @else
                    <span class="badge badge--secondary">Inactivo</span>
                    @endif
                </td>
                
                <td>{{ $alumno->telefono ?? '---' }}</td>
                
                <td style="text-align:center">

                    <button class="btn btn--info js-ver" data-id="{{ $alumno->id }}">
                        Ver
                    </button>

                    <button class="btn btn--warning js-editar" data-id="{{ $alumno->id }}">
                        Editar
                    </button>

                    <form action="{{ route('alumnos.destroy', $alumno->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn--danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:20px; text-align: center;">
                    No hay alumnos registrados.
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