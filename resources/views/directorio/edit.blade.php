<x-app-layout>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="mb-4">Editar Registro del Directorio</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('directorio.update', $directorio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $directorio->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="catedra" class="form-label">Cátedra</label>
            <select name="catedra" id="catedra" class="form-select" required>
                <option value="Coordinador" {{ $directorio->catedra == 'Coordinador' ? 'selected' : '' }}>Coordinador</option>
                <option value="Asistente de coordinación" {{ $directorio->catedra == 'Asistente de coordinación' ? 'selected' : '' }}>Asistente de coordinación</option>
                <option value="Comité Técnico" {{ $directorio->catedra == 'Comité Técnico' ? 'selected' : '' }}>Comité Técnico</option>
                <option value="Comité Honorifico" {{ $directorio->catedra == 'Comité Honorifico' ? 'selected' : '' }}>Comité Honorifico</option>
                <option value="Colaboradores" {{ $directorio->catedra == 'Colaboradores' ? 'selected' : '' }}>Colaboradores</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $directorio->correo) }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $directorio->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            @if ($directorio->imagen)
                <p class="mt-2">Imagen actual:</p>
                <img src="{{ asset('storage/' . $directorio->imagen) }}" alt="Imagen actual" class="img-thumbnail" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('directorio.admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-app-layout>
