<x-app-layout>
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="mb-4">Agregar Persona al Directorio</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('directorio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="catedra" class="form-label">Puesto:</label>
            <select name="catedra" id="catedra" class="form-control" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Coordinador">Coordinador</option>
                <option value="Asistente de coordinación">Asistente de coordinación</option>
                <option value="Comité Técnico">Comité Técnico</option>
                <option value="Comité Honorifico">Comité Honorifico</option>
                <option value="Colaboradores">Colaboradores</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('directorio.admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-app-layout>