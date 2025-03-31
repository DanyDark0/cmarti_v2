<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documentos') }}
        </h2>
    </x-slot>
<div class="container p-2">
    <h1 class="text-2xl font-bold mb-6 text-center">Administración de documentos</h1>

    {{-- Formulario de buscador --}}
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('documentos.buscar_admin') }}" method="POST" class="flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar documentos..." class="form-input w-60 sm:w-96 p-2 border border-gray-300 rounded-md mr-2">
            <button type="submit" class="bg-gray-400 hover:text-white text-dark px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">
                Buscar
            </button>
        </form>
    </div>

    <!-- Botón para crear nueva documento -->
    <a href="{{ route('documentos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        <button>Nueva documento</button>
    </a>

    <!-- Tabla de documentos -->
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
                        @can('Eliminar documentos')
                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" class="inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm" onclick="return confirm('¿Estás seguro de eliminar esta documento?');">Eliminar</button>
                        </form>
                        @endcan
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