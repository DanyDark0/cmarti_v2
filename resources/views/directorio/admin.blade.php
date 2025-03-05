@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Directorio</h1>

    <a href="{{ route('directorio.create') }}" class="btn btn-primary mb-3">Agregar Nuevo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Cátedra</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($directorio as $persona)
                <tr>
                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>
                        @if($persona->imagen)
                            <img src="{{ asset('storage/' . $persona->imagen) }}" alt="Imagen" width="60">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $persona->catedra }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>
                        <a href="{{ route('directorio.edit', $persona->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('directorio.destroy', $persona->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
