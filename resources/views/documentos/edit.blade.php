<x-app-layout>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Editar documentos</h2>
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
    
    <!-- Formulario para editar un documentos -->
    <form action="{{ route('documentos.update', $documento->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT') <!-- Método PUT para la actualización -->

        <!-- Campo para el título -->
        <div class="mb-3">
            <label for="titulo" class="form-label font-bold">Título</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $documento->titulo) }}" autocomplete="off">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para la descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label font-bold">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $documento->descripcion) }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para el archivo doc1 -->
        <div class="mb-3">
            <label for="doc1" class="form-label font-bold">Documento 1</label>
            <input type="file" class="form-control @error('doc1') is-invalid @enderror" id="doc1" name="doc1" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <!-- Mostrar el archivo actual si existe -->
            @if ($documento->doc1)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $documento->doc1) }}" target="_blank">Ver  {{ basename($documento->doc1)}}</a>
                </div>
            @endif
        </div>

        <!-- Campo para el archivo doc2 -->
        <div class="mb-3">
            <label for="doc2" class="form-label font-bold">Documento 2</label>
            <input type="file" class="form-control @error('doc2') is-invalid @enderror" id="doc2" name="doc2" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <!-- Mostrar el archivo actual si existe -->
            @if ($documento->doc2)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $documento->doc2) }}" target="_blank">Ver {{ basename($documento->doc2)}}</a>
                </div>
            @endif
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
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
