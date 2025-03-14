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

        <!-- Imagen directorio -->
        <div class="mb-3">
            <label for="imagen" class="form-label font-bold">Imagen 1</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept=".jpeg,.png,.jpg,.gif" onchange="previewImage(event, 'preview_img1', 'text_img1', 'btn_eliminar_img1')">
            @if(isset($directorio) && $directorio->imagen)
                    <p id="text_img1">Imagen actual:</p>
                    <img id="preview_img1" src="{{ asset($directorio->imagen) }}" alt="Imagen 1" width="150">
                    <button type="button" id="btn_eliminar_img1" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('{{ route('directorios.eliminarArchivo', ['id' => $directorio->id, 'campo' => 'imagen']) }}', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'imagen')">Eliminar</button>
                @else
                    <p id="text_img1" style="display:none;">Imagen seleccionada:</p>
                    <img id="preview_img1" src="" alt="Previsualización" width="150" style="display:none;">
                    <button type="button" id="btn_eliminar_img1" style="display:none;" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'imagen')">Eliminar</button>
            @endif
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


        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('directorio.admin') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
function previewImage(event, previewId, textId, buttonId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    const text = document.getElementById(textId);
    const button = document.getElementById(buttonId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            text.style.display = 'block';
            button.style.display = 'inline-block'; // Muestra el botón
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        text.style.display = 'none';
        button.style.display = 'none'; // Oculta el botón si no hay imagen
    }
}

function eliminarArchivo(url, previewId = null, textId = null, btnId = null, inputId = null) {
    if (!url) {
        // Si no hay URL, es una previsualización local, solo ocultar la imagen
        if (previewId) {
            document.getElementById(previewId).style.display = 'none';
        }
        if (textId) {
            document.getElementById(textId).style.display = 'none'
        }
        if (btnId) {
            document.getElementById(btnId).style.display = 'none';
        }
        if (inputId) {
            document.getElementById(inputId).value = ''; // Limpiar el input de tipo file
        }
        alert("La imagen ha sido eliminada de la previsualización.");
    } else {
        // Si hay URL, realizar la eliminación en el servidor
        if (confirm("¿Seguro que deseas eliminar este archivo?")) {
            fetch(url, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Archivo eliminado correctamente.");
                        if (previewId) {
                            document.getElementById(previewId).style.display = 'none';
                        }
                        if (btnId) {
                            document.getElementById(btnId).style.display = 'none';
                        }
                        if (btnId) {
                            document.getElementById(btnId).style.display = 'none';
                        }
                        if (inputId) {
                            document.getElementById(inputId).value = ''; // Limpiar el input de tipo file
                        }
                        location.reload();
                    } else {
                        alert("Error al eliminar el archivo.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    }
}
</script>
</x-app-layout>
