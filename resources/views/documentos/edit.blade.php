<div class="container">
    <h2>Editar documentos</h2>
    
    <!-- Formulario para editar un documentos -->
    <form action="{{ route('documentos.update', $documentos->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Método PUT para la actualización -->

        <!-- Campo para el título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $documentos->titulo) }}">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para la descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $documentos->descripcion) }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para el archivo doc1 -->
        <div class="mb-3">
            <label for="doc1" class="form-label">documentos 1</label>
            <input type="file" class="form-control @error('doc1') is-invalid @enderror" id="doc1" name="doc1" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <!-- Mostrar el archivo actual si existe -->
            @if ($documentos->doc1)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $documentos->doc1) }}" target="_blank">Ver documentos 1</a>
                </div>
            @endif
        </div>

        <!-- Campo para el archivo doc2 -->
        <div class="mb-3">
            <label for="doc2" class="form-label">documentos 2</label>
            <input type="file" class="form-control @error('doc2') is-invalid @enderror" id="doc2" name="doc2" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <!-- Mostrar el archivo actual si existe -->
            @if ($documentos->doc2)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $documentos->doc2) }}" target="_blank">Ver documentos 2</a>
                </div>
            @endif
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
