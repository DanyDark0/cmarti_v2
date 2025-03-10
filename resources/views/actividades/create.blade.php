@extends('layouts.userapp')

@section('content')
<style>
    .fecha {
        
    }
</style>
<div class="container">
    <h1>Crear Nueva Actividad</h1>
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
    <form action="{{ route('actividades.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" >
        </div>
        
        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
        </div>
        
        <!-- Fecha -->
        <div class="fecha mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control">
        </div>
        
        <!-- Imagen 1 -->
        <div class="mb-3">
            <label for="url_img1" class="form-label">Imagen 1</label>
            <input type="file" name="url_img1" id="url_img1" class="form-control" accept=".jpeg,.png,.jpg,.gif">
        </div>
        
        <!-- Imagen 2 -->
        <div class="mb-3">
            <label for="url_img2" class="form-label">Imagen 2</label>
            <input type="file" name="url_img2" id="url_img2" class="form-control" accept=".jpeg,.png,.jpg,.gif">
        </div>
        
        <!-- Archivo 1 -->
        <div class="mb-3">
            <label for="archivo1" class="form-label">Archivo 1</label>
            <input type="file" name="archivo1" id="archivo1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        </div>
        
        <!-- Archivo 2 -->
        <div class="mb-3">
            <label for="archivo2" class="form-label">Archivo 2</label>
            <input type="file" name="archivo2" id="archivo2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        </div>

        <!-- Campo Noticia -->
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="noticia" id="noticia" value="1">
            <label class="form-check-label w-full mb-5 text-sm" for="noticia">Marcar como noticia</label>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Guardar Actividad</button>
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
@endsection
