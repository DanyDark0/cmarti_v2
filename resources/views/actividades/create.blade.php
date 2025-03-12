<x-app-layout>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear Nueva Actividad</h1>
        
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
        
        <form action="{{ route('actividades.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-gray-700 font-semibold">Título</label>
                <input type="text" name="titulo" id="titulo" class="w-full p-2 border rounded-lg" value="{{ old('titulo')}}">
            </div>
            
        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion')}}</textarea>
                        <!-- Manejo de errores en el validador-->
                        @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
        </div>

            <!-- Fecha -->
            <div>
                <label for="fecha" class="block text-gray-700 font-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full p-2 border rounded-lg" value="{{ old('fecha')}}">
            </div>
            
            <!-- Imagen 1 -->
            <div>
                <label for="url_img1" class="block text-gray-700 font-semibold">Imagen 1</label>
                <input type="file" name="url_img1" id="url_img1" accept=".jpeg,.png,.jpg" class="w-full p-2 border rounded-lg">
            </div>
            
            <!-- Imagen 2 -->
            <div>
                <label for="url_img2" class="block text-gray-700 font-semibold">Imagen 2</label>
                <input type="file" name="url_img2" id="url_img2" accept=".jpeg,.png,.jpg"  class="w-full p-2 border rounded-lg">
            </div>
            
            <!-- Archivo 1 -->
            <div>
                <label for="archivo1" class="block text-gray-700 font-semibold">Archivo 1</label>
                <input type="file" name="archivo1" id="archivo1" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="w-full p-2 border rounded-lg">
            </div>
            
            <!-- Archivo 2 -->
            <div>
                <label for="archivo2" class="block text-gray-700 font-semibold">Archivo 2</label>
                <input type="file" name="archivo2" id="archivo2" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="w-full p-2 border rounded-lg">
            </div>
            
            <!-- Campo Noticia -->
            <div class="flex items-center">
                <label for="noticia" class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="noticia" id="noticia" value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-2 peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500"></div>
                    <span class="ml-3 text-gray-700 font-semibold">Marcar como noticia</span>
                </label>
            </div>
            
            <button type="submit" class="w-30 bg-green-500 hover:bg-green-600 text-white  py-2 px-3 text-center rounded">Guardar Actividad</button>
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
                    tinymce.triggerSave(); // Sincroniza el contenido
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
</script>
</x-app-layout>