<x-app-layout>
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Crear Documento</h2>
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
    <!-- Formulario para crear un documento -->
    <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Campo para el título -->
        <div class="mb-3">
            <label for="titulo" class="block text-gray-700 font-semibold">Título</label>
            <input type="text" name="titulo" id="titulo" class="w-full p-2 border rounded-lg" value="{{ old('titulo')}}">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para la descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para el archivo doc1 -->
        <div class="mb-3">
            <label for="doc1" class="form-label">Documento 1</label>
            <input type="file" class="form-control @error('doc1') is-invalid @enderror" id="doc1" name="doc1" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para el archivo doc2 -->
        <div class="mb-3">
            <label for="doc2" class="form-label">Documento 2</label>
            <input type="file" class="form-control @error('doc2') is-invalid @enderror" id="doc2" name="doc2" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
            @error('doc2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="flex h-16">
            <button type="submit" class="w-30 bg-green-500 hover:bg-green-600 text-white  py-2 px-3 text-center rounded">Guardar Documento</button>
            </div>

    </form>
</div>
</x-app-layout>