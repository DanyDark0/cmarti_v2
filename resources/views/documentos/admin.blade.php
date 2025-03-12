<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">Administración de documentos</h1>

    <!-- Botón para crear nueva documento -->
    <a href="{{ route('documentos.create') }}" class="btn btn-primary mb-3">Nueva documento</a>

    <!-- Tabla de documentoes -->
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Título</th>
                <th class="py-3 px-6 text-left">Documento 1</th>
                <th class="py-3 px-6 text-left">Documento 2</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($documentos as $documento)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $documento->id }}</td>
                    <td class="py-3 px-6 text-left whitespace-nowrap overflow-hidden truncate max-w-[200px]">{{ Str::limit($documento->titulo, 80, '...') }}</td>
                    <td class="py-3 px-6 text-left">{{ Str::limit($documento->doc1, 20, '...') }}</td>
                    <td class="py-3 px-6 text-left">{{ Str::limit($documento->doc2, 20, '...') }}</td>
                    <td>
                        <div class="flex justify-center gap-2">
                        <!-- Editar -->
                        <a href="{{ route('documentos.edit', $documento->slug) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">Editar</a>

                        <!-- Eliminar -->
                        <form action="{{ route('documentos.destroy', $documento->slug) }}" method="POST" class="inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm" onclick="return confirm('¿Estás seguro de eliminar esta documento?');">Eliminar</button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <div class="d-flex justify-content-center mt-4">
        {{ $documentos->links() }}
    </div>
</div>
</x-app-layout>