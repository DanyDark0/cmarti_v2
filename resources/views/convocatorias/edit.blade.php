<x-app-layout>
    <div class="container mb-4">
        <h1>Editar Convocatoria</h1>
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
    
        <form action="{{ route('convocatorias.update', $convocatoria->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
                    <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control"
                    value="{{ old('titulo', $convocatoria->titulo ?? '') }}" required>
            </div>
    
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion', $convocatoria->descripcion ?? '') }}</textarea>
            </div>
    
            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control w-32"
                    value="{{ $convocatoria->fecha }}" required>
            </div>
    
            <!-- Imagen 1 -->
            <div class="mb-3">
                <label for="url_img1" class="form-label">Imagen 1</label>
                <input type="file" name="url_img1" id="url_img1" class="form-control" accept=".jpeg,.png,.jpg,.gif">
                @if(isset($convocatoria) && $convocatoria->url_img1)
                    <div class="mt-2">
                        <p>Imagen actual:</p>
                        <img src="{{ asset($convocatoria->url_img1) }}" alt="Imagen 1" width="150">
                    </div>
                @endif
            </div>
    
            <!-- Imagen 2 -->
            <div class="mb-3">
                <label for="url_img2" class="form-label">Imagen 2</label>
                <input type="file" name="url_img2" id="url_img2" class="form-control" accept=".jpeg,.png,.jpg,.gif">
                @if(isset($convocatoria) && $convocatoria->url_img2)
                    <div class="mt-2">
                        <p>Imagen actual:</p>
                        <img src="{{ asset($convocatoria->url_img2) }}" alt="Imagen 2" width="150">
                    </div>
                @endif
            </div>
    
            <!-- Archivo 1 -->
            <div class="mb-3">
                <label for="archivo1" class="form-label">Archivo 1</label>
                <input type="file" name="archivo1" id="archivo1" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                @if(isset($convocatoria) && $convocatoria->archivo1)
                    <div class="mt-2">
                        <p>Archivo actual: <a href="{{ asset($convocatoria->archivo1) }}" target="_blank">Ver archivo</a></p>
                    </div>
                @endif
            </div>
    
            <!-- Archivo 2 -->
            <div class="mb-3">
                <label for="archivo2" class="form-label">Archivo 2</label>
                <input type="file" name="archivo2" id="archivo2" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                @if(isset($convocatoria) && $convocatoria->archivo2)
                    <div class="mt-2">
                        <p>Archivo actual: <a href="{{ asset($convocatoria->archivo2) }}" target="_blank">Ver archivo</a></p>
                    </div>
                @endif
            </div>
    
            <button type="submit" class="btn btn-primary mt-3">Actualizar convocatoria</button>
        </form>
    
        <a href="{{ route('convocatorias.admin') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '#descripcion', // Selector del textarea
                plugins: 'link image media table codesample fullscreen',
                toolbar: 'undo redo | styleselect | bold italic | link image media | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table codesample fullscreen',
                height: 300,
                menubar: false,
                branding: false,
                automatic_uploads: true,
            });
    
            document.addEventListener("DOMContentLoaded", function () {
    
            fechaInput.addEventListener("input", function () {
                let partes = this.value.split("/");
                if (partes.length === 3) {
                    let nuevaFecha = `${partes[2]}-${partes[1]}-${partes[0]}`;
                    this.value = nuevaFecha;
                }
            });
        });
        </script>
    </x-app-layout>