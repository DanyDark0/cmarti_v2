<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Directorio') }}
        </h2>
       </x-slot>

    <div class="container p-2">

    <h1 class="text-2xl font-bold mb-6 text-center">Administración de Directorio</h1>

    {{-- Formulario de buscador --}}
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('directorio.buscar_admin') }}" method="POST" class="flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar persona..." class="form-input w-60 sm:w-96 p-2 border border-gray-300 rounded-md mr-2">
            <button type="submit" class="bg-gray-400 hover:text-white text-dark px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">
                Buscar
            </button>
        </form>
    </div>

        <!-- Botón para agregar nuevo -->
        <a href="{{ route('directorio.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            <button>Agregar Nuevo</button>
        </a>

        <!-- Tabla de directorio -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nombre</th>
                        <th class="py-3 px-6 text-center">Imagen</th>
                        <th class="py-3 px-6 text-left">Cátedra</th>
                        <th class="py-3 px-6 text-left">Correo</th>
                        <th class="py-3 px-6 text-left">Teléfono</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($directorio as $persona)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $persona->id }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap overflow-hidden truncate max-w-[200px]">
                                {{ Str::limit($persona->nombre, 15, '...') }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if($persona->imagen)
                                    <img src="{{ asset( $persona->imagen) }}" alt="Imagen" class="w-16 h-16 object-cover rounded-full mx-auto">
                                @else
                                    <span class="text-gray-500">Sin imagen</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ $persona->catedra }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap overflow-hidden truncate max-w-[200px]">{{ Str::limit($persona->correo, 15) }}</td>
                            <td class="py-3 px-6 text-left">{{ $persona->telefono }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('directorio.edit', $persona->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded text-sm">
                                        Editar
                                    </a>

                                    <!-- Botón Eliminar -->
                                    @can('Eliminar directorio')
                                    <form action="{{ route('directorio.destroy', $persona->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center mt-6">
            {{ $directorio->links() }}
        </div>
    </div>
</x-app-layout>
