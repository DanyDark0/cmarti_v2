<div class="container">
    <h1 class="mb-4">Administración de Convocatorias</h1>

    <!-- Botón para crear nueva convocatoria -->
    <a href="{{ route('convocatorias.create') }}" class="btn btn-primary mb-3">Nueva convocatoria</a>

    <!-- Tabla de convocatoriaes -->
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
            @foreach($convocatorias as $convocatoria)
                <tr>
                    <td>{{ $convocatoria->id }}</td>
                    <td>{{ $convocatoria->titulo }}</td>
                    <td>{{ $convocatoria->fecha }}</td>
                    <td>
                        <!-- Editar -->
                        <a href="{{ route('convocatorias.edit', $convocatoria->slug) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Eliminar -->
                        <form action="{{ route('convocatorias.destroy', $convocatoria->slug) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta convocatoria?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $convocatorias->links() }}
    </div>
</div>