<x-app-layout>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Editar Actividad</h1>
                <!-- Muestra errores generales -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
        <form action="{{ route('actividades.update', $actividad->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
    <!-- Título -->
    <div class="mb-3">
        <label for="titulo" class="form-label font-bold">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control"
               value="{{ old('titulo', $actividad->titulo ?? '') }}" required>
    </div>

    <!-- Descripción -->
    <div class="mb-3">
        <label for="descripcion" class="form-label font-bold">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion', $actividad->descripcion ?? '') }}</textarea>
    </div>

<!-- Fecha -->
<div class="mb-3">
    <label for="fecha" class="form-label font-bold">Fecha</label>
    <input type="date" name="fecha" id="fecha" style="width: 150px" class="form-control"
           value="{{ $actividad->fecha }}">
</div>

        <!-- Imagen 1 actividad -->
        <div class="mb-3">
            <label for="url_img1" class="form-label font-bold">Imagen 1</label>
            <input type="file" name="url_img1" id="url_img1" class="form-control" accept=".jpeg,.png,.jpg,.gif" onchange="previewImage(event, 'preview_img1', 'text_img1', 'btn_eliminar_img1')">
            @if(isset($actividad) && $actividad->url_img1)
                    <p id="text_img1">Imagen actual:</p>
                    <img id="preview_img1" src="{{ asset($actividad->url_img1) }}" alt="Imagen 1" width="150">
                    <button type="button" id="btn_eliminar_img1" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('{{ route('actividades.eliminarArchivo', ['slug' => $actividad->slug, 'campo' => 'url_img1']) }}', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'url_img1')">Eliminar</button>
                @else
                    <p id="text_img1" style="display:none;">Imagen seleccionada:</p>
                    <img id="preview_img1" src="" alt="Previsualización" width="150" style="display:none;">
                    <button type="button" id="btn_eliminar_img1" style="display:none;" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'url_img1')">Eliminar</button>
            @endif
        </div>

    <!-- Imagen 2 actividad-->
    <div class="mb-3">
        <label for="url_img2" class="form-label font-bold">Imagen 2</label>
        <input type="file" name="url_img2" id="url_img2" class="form-control" accept=".jpeg,.png,.jpg,.gif" onchange="previewImage(event, 'preview_img2', 'text_img2', 'btn_eliminar_img2')">
        @if(isset($actividad) && $actividad->url_img2)
                <p id="text_img2">Imagen actual:</p>
                    <img id="preview_img2" src="{{ asset($actividad->url_img2) }}" alt="Imagen 2" width="150">
                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('{{ route('actividades.eliminarArchivo', ['slug' => $actividad->slug, 'campo' => 'url_img2']) }}', 'preview_img2', 'text_img2', 'btn_eliminar_img2')">Eliminar</button>
            @else
                <p id="text_img2" style="display:none;">Imagen seleccionada:</p>
                <img id="preview_img2" src="" alt="Previsualización" width="150" style="display:none;">
                <button type="button" id="btn_eliminar_img2" style="display:none;" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('', 'preview_img2', 'text_img2' , 'btn_eliminar_img2', 'url_img2')">Eliminar</button>
        @endif
    </div>

    <!-- Archivo 1 actividad-->
    <div class="mb-3">

        <label for="archivo1" class="form-label font-bold">Archivo 1</label>
        <input type="file" name="archivo1" id="archivo1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        @if(isset($actividad) && $actividad->archivo1)
                <p>Archivo actual: <a href="{{ asset($actividad->archivo1) }}" target="_blank">Ver {{basename($actividad->archivo1)}}</a></p>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArchivo('{{ route('actividades.eliminarArchivo', ['slug' => $actividad->slug, 'campo' => 'archivo1']) }}')">Eliminar</button>
        @endif
    </div>

    <!-- Archivo 2 -->
    <div class="mb-3">
        <label for="archivo2" class="form-label font-bold">Archivo 2</label>
        <input type="file" name="archivo2" id="archivo2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        @if(isset($actividad) && $actividad->archivo2)
            <div class="mt-2">
                <p>Archivo actual: <a href="{{ asset($actividad->archivo2) }}" target="_blank">Ver {{basename($actividad->archivo2)}}</a></p>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArchivo('{{ route('actividades.eliminarArchivo', ['slug' => $actividad->slug, 'campo' => 'archivo2']) }}')">Eliminar</button>
            </div>
        @endif
    </div>
    
<!-- Campo Noticia -->
<div class="flex items-center">
    <label for="noticia" class="relative inline-flex items-center cursor-pointer">
    <input class="form-check-input sr-only peer" type="checkbox" name="noticia" id="noticia" value="1"
        {{ old('noticia', $actividad->noticia ?? 0) == 1 ? 'checked' : '' }}>
        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500"></div>
    <span class="ml-3 text-gray-700 font-semibold" for="noticia">Marcar como noticia</span>
    </label>
</div>
    
            <button type="submit" class="btn btn-primary mt-3">Actualizar Actividad</button>
        </form>
    
        <a href="{{ route('actividades.admin') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#descripcion',
            plugins: 'link image media table codesample fullscreen',
            toolbar: 'undo redo | styleselect | bold italic | link image media | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table codesample fullscreen',
            height: 300,
            menubar: false,
            branding: false,
            automatic_uploads: true,

            setup: function (editor) {
                editor.on('change', function () {
                    editor.save(); // Guarda el contenido en el <textarea>
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function () {

        fechaInput.addEventListener("input", function () {
            let partes = this.value.split("/");
            if (partes.length === 3) {
                let nuevaFecha = `${partes[2]}-${partes[1]}-${partes[0]}`;
                this.value = nuevaFecha;
            }
        });

        form.addEventListener("submit", function (event) {
        tinymce.triggerSave(); // Fuerza la actualización del textarea oculto

        const textarea = document.getElementById("descripcion");
        if (!textarea.value.trim()) {
            alert("El campo Descripción es obligatorio.");
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
    
    });

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