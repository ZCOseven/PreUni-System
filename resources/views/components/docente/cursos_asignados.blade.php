<div class="docente-cursos">
    <h2 class="docente-cursos__title">Cursos asignados a {{ $docente->nombre }} {{ $docente->apellido_paterno }}</h2>

    @if($asignaturas->isEmpty())
        <p class="docente-cursos__empty">No tiene cursos asignados.</p>
    @else
        <table class="docente-cursos__table">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Periodo</th>
                    <th>Horario</th>
                    <th>Aula</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignaturas as $asig)
                    <tr>
                        <td>{{ $asig->curso->nombre ?? '—' }}</td>
                        <td>{{ $asig->periodo ?? '—' }}</td>
                        <td>{{ $asig->horarioFormateado() ?? '—' }}</td>
                        <td>{{ $asig->aula ?? '—' }}</td>
                        <td class="docente-cursos__estado {{ $asig->estado == 'activo' ? 'docente-cursos__estado--success' : 'docente-cursos__estado--danger' }}">
                            {{ ucfirst($asig->estado) ?? '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
