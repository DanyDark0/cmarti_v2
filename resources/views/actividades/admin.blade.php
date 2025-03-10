@extends('layouts.userapp')

@section('content')
<style>
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-item.active .page-link {
    background-color: #ff5733; /* Color de fondo del botón activo */
    border-color: #ff5733;
    color: white;
}

.pagination .page-link {
    color: #333; /* Color de los enlaces */
    border: 1px solid #ddd;
}

.pagination .page-link:hover {
    background-color: #ffcc99; /* Color al pasar el mouse */
    border-color: #ffcc99;
    color: #000;
}

</style>
<div class="container">
    <h1 class="mb-4">Administración de Actividades</h1>

    <!-- Botón para crear nueva actividad -->
    <a href="{{ route('actividades.create') }}" class="btn btn-primary mb-3">Nueva Actividad</a>

    <!-- Tabla de actividades -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
                <tr>
                    <td>{{ $actividad->id }}</td>
                    <td>{{ $actividad->titulo }}</td>
                    <td>{{ $actividad->fecha }}</td>
                    <td>
                        <!-- Editar -->
                        <a href="{{ route('actividades.edit', $actividad->slug) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Eliminar -->
                        <form action="{{ route('actividades.destroy', $actividad->slug) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta actividad?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $actividades->links() }}
    </div>
</div>
@endsection
