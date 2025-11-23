<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Dashboard</h1>

    <form action="{{ route('logout') }}" method="post" style="display: inline;">
        @csrf
        <button type="submit">Cerrar Sesion</button>
    </form>

    <br>

    <a href="{{ route('alumnos.index') }}" class="btn btn-primary">
        Ir a Alumnos
    </a>

    <br>

    <a href="{{ route('docentes.index') }}" class="btn btn-primary">
        Ir a Docente
    </a>

    <br>

    <a href="{{ route('cursos.index') }}" class="btn btn-primary">
        Ir a Cursos
    </a>

    <br>

    <a href="{{ route('asignaturas.index') }}" class="btn btn-primary">
        Ir a Asignaturas
    </a>

    <br>

    <a href="{{ route('matriculas.index') }}" class="btn btn-primary">
        Ir a Matriculas 
    </a>

</body>

</html>