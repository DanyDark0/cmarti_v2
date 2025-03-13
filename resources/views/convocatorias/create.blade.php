<x-app-layout>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear Nueva Convocatoria</h1>
            <!-- Muestra errores generales -->
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('convocatorias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
    
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-gray-700 font-semibold">Título</label>
                <input type="text" name="titulo" id="titulo" class="w-full p-2 border rounded-lg" value="{{ old('titulo')}}">
                <!-- Manejo de errores en el validador-->
                @error('titulo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label font-bold">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion')}}</textarea>
                            <!-- Manejo de errores en el validador-->
                            @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
            </div>
            
            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label font-bold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" style="width: 150px" value="{{ old('fecha')}}">
                            <!-- Manejo de errores en el validador-->
                            @error('fecha')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>

        <!-- Imagen 1 -->
        <div class="mb-3">
            <label for="url_img1" class="form-label font-bold">Imagen 1</label>
            <input type="file" name="url_img1" id="url_img1" class="form-control" accept=".jpeg,.png,.jpg,.gif" onchange="previewImage(event, 'preview_img1', 'text_img1', 'btn_eliminar_img1')">
            @if(isset($convocatoria) && $convocatoria->url_img1)
                    <p id="text_img1">Imagen actual:</p>
                    <img id="preview_img1" src="{{ asset($convocatoria->url_img1) }}" alt="Imagen 1" width="150">
                    <button type="button" id="btn_eliminar_img1" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('{{ route('convocatorias.eliminarArchivo', ['slug' => $convocatoria->slug, 'campo' => 'url_img1']) }}', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'url_img1')">Eliminar</button>
                @else
                    <p id="text_img1" style="display:none;">Imagen seleccionada:</p>
                    <img id="preview_img1" src="" alt="Previsualización" width="150" style="display:none;">
                    <button type="button" id="btn_eliminar_img1" style="display:none;" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('', 'preview_img1', 'text_img1' , 'btn_eliminar_img1', 'url_img1')">Eliminar</button>
            @endif
        </div>
            
        <!-- Imagen 2 -->
        <div class="mb-3">
            <label for="url_img2" class="form-label font-bold">Imagen 2</label>
            <input type="file" name="url_img2" id="url_img2" class="form-control" accept=".jpeg,.png,.jpg,.gif" onchange="previewImage(event, 'preview_img2', 'text_img2', 'btn_eliminar_img2')">
            @if(isset($convocatoria) && $convocatoria->url_img2)
                    <p id="text_img2">Imagen actual:</p>
                        <img id="preview_img2" src="{{ asset($convocatoria->url_img2) }}" alt="Imagen 2" width="150">
                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('{{ route('convocatorias.eliminarArchivo', ['slug' => $convocatoria->slug, 'campo' => 'url_img2']) }}', 'preview_img2', 'text_img2', 'btn_eliminar_img2')">Eliminar</button>
                @else
                    <p id="text_img2" style="display:none;">Imagen seleccionada:</p>
                    <img id="preview_img2" src="" alt="Previsualización" width="150" style="display:none;">
                    <button type="button" id="btn_eliminar_img2" style="display:none;" class="btn btn-danger btn-sm mt-2" onclick="eliminarArchivo('', 'preview_img2', 'text_img2' , 'btn_eliminar_img2', 'url_img2')">Eliminar</button>
            @endif
        </div>
            
            <!-- Archivo 1 -->
            <div class="mb-3">
                <label for="archivo1" class="form-label font-bold">Archivo 1</label>
                <input type="file" name="archivo1" id="archivo1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            </div>
            
            <!-- Archivo 2 -->
            <div class="mb-3">
                <label for="archivo2" class="form-label font-bold">Archivo 2</label>
                <input type="file" name="archivo2" id="archivo2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            </div>
            <div class="flex h-16">
            <button type="submit" class="w-30 bg-green-500 hover:bg-green-600 text-white  py-2 px-3 text-center rounded">Guardar Convocatoria</button>
            </div>
        </form>
    </div>
    
    
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '#descripcion',
                plugins: 'link image media table codesample fullscreen',
                toolbar: 'undo redo | styleselect | bold italic | link image media | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table codesample fullscreen',
                height: 300,
                menubar: false,
                branding: false,
                automatic_uploads: true,
                setup: function(editor) {
                    editor.on('init', function() {
                        // Cargar el valor de old() en TinyMCE al iniciar
                        editor.setContent(document.getElementById('descripcion').value);
                    });
    
                    editor.on('change', function() {
                        tinymce.triggerSave(); // Sincroniza el contenido con el textarea oculto
                    });
                }
            });
    
            document.querySelector("form").addEventListener("submit", function(event) {
                tinymce.triggerSave(); // Asegura que TinyMCE pase los datos al textarea
    
                let descripcion = document.querySelector("#descripcion");
                let fecha = document.querySelector("#fecha");
    
                // Verifica manualmente si los campos tienen valores
                if (!descripcion.value.trim()) {
                    alert("Por favor, ingresa una descripción.");
                    event.preventDefault();
                    return;
                }
    
                if (!fecha.value.trim()) {
                    alert("Por favor, selecciona una fecha.");
                    event.preventDefault();
                    return;
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
            document.getElementById(textId).style.display = 'none';
        }
        if (btnId) {
            document.getElementById(btnId).style.display = 'none'; // Ocultar el botón de eliminación
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
                        // Ocultar la previsualización y el botón de eliminación
                        if (previewId) {
                            document.getElementById(previewId).style.display = 'none';
                        }
                        if (textId) {
                            document.getElementById(textId).style.display = 'none';
                        }
                        if (btnId) {
                            document.getElementById(btnId).style.display = 'none'; // Ocultar el botón de eliminación
                        }
                        if (inputId) {
                            document.getElementById(inputId).value = ''; // Limpiar el input de tipo file
                        }
                        location.reload(); // Recargar la página después de la eliminación
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
    