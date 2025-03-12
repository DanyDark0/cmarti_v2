    <!-- Título -->
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control"
               value="{{ old('titulo', $actividad->titulo ?? '') }}" required>
    </div>

    <!-- Descripción -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion', $actividad->descripcion ?? '') }}</textarea>
    </div>

<!-- Fecha -->
<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" name="fecha" id="fecha" class="form-control w-32"
           value="{{ $actividad->fecha }}" required>
</div>

    <!-- Imagen 1 -->
    <div class="mb-3">
        <label for="url_img1" class="form-label">Imagen 1</label>
        <input type="file" name="url_img1" id="url_img1" class="form-control" accept=".jpeg,.png,.jpg,.gif">
        @if(isset($actividad) && $actividad->url_img1)
            <div class="mt-2">
                <p>Imagen actual:</p>
                <img src="{{ asset($actividad->url_img1) }}" alt="Imagen 1" width="150">
            </div>
        @endif
    </div>

    <!-- Imagen 2 -->
    <div class="mb-3">
        <label for="url_img2" class="form-label">Imagen 2</label>
        <input type="file" name="url_img2" id="url_img2" class="form-control" accept=".jpeg,.png,.jpg,.gif">
        @if(isset($actividad) && $actividad->url_img2)
            <div class="mt-2">
                <p>Imagen actual:</p>
                <img src="{{ asset($actividad->url_img2) }}" alt="Imagen 2" width="150">
            </div>
        @endif
    </div>

    <!-- Archivo 1 -->
    <div class="mb-3">
        <label for="archivo1" class="form-label">Archivo 1</label>
        <input type="file" name="archivo1" id="archivo1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        @if(isset($actividad) && $actividad->archivo1)
            <div class="mt-2">
                <p>Archivo actual: <a href="{{ asset($actividad->archivo1) }}" target="_blank">Ver archivo</a></p>
            </div>
        @endif
    </div>

    <!-- Archivo 2 -->
    <div class="mb-3">
        <label for="archivo2" class="form-label">Archivo 2</label>
        <input type="file" name="archivo2" id="archivo2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        @if(isset($actividad) && $actividad->archivo2)
            <div class="mt-2">
                <p>Archivo actual: <a href="{{ asset($actividad->archivo2) }}" target="_blank">Ver archivo</a></p>
            </div>
        @endif
    </div>
    
<!-- Campo Noticia -->
<div class="flex items-center">
    <label for="noticia" class="relative inline-flex items-center cursor-pointer">
    <input class="form-check-input sr-only peer" type="checkbox" name="noticia" id="noticia" value="1"
        {{ old('noticia', $actividad->noticia ?? 0) == 1 ? 'checked' : '' }}>
        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-2 peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500"></div>
    <span class="ml-3 text-gray-700 font-semibold" for="noticia">Marcar como noticia</span>
    </label>
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
    </script>
