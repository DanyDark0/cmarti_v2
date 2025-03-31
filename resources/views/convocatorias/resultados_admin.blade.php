<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Convocatorias') }}
        </h2>
       </x-slot>

<div class="container mx-auto p-6">

    {{-- Formulario de buscador exclusivo de actividades --}}
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('convocatorias.buscar_admin') }}" method="POST" class="flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar convocatoria..." class="form-input w-60 sm:w-96 p-2 border border-gray-300 rounded-md mr-2">
            <button type="submit" class="bg-gray-400 hover:text-white text-dark px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">
                Buscar
            </button>
        </form>
    </div>

{{-- Mostrar el total de resultados --}}
<div class="my-4">
    <p class="text-lg font-semibold">Total de resultados: {{ $totalResultados }}</p>
</div>

{{-- Mostrar los resultados de búsqueda --}}
@if($convocatorias->isNotEmpty())
   <!-- Tabla de convocatorias -->
   <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Título</th>
                <th class="py-3 px-6 text-left">Fecha</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($convocatorias as $convocatoria)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $convocatoria->id }}</td>
                    <td class="py-3 px-6 text-left whitespace-nowrap overflow-hidden truncate max-w-[200px]">{{ Str::limit($convocatoria->titulo, 80, '...') }}</td>
                    <td class="py-3 px-6 text-left">{{ $convocatoria->fecha }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center gap-2">
                            <!-- Botón Editar -->
                            <a href="{{ route('convocatorias.edit', $convocatoria->slug) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded text-sm">
                                Editar
                            </a>

                            <!-- Botón Eliminar -->
                            @can('Eliminar convocatorias')
                            <form action="{{ route('convocatorias.destroy', $convocatoria->id) }}" class="inline-block;" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta convocatoria?');">
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


    {{-- Paginación --}}
    <div class="pagination">
        {{ $convocatorias->links() }}
    </div>
@else
    <p>No se encontraron resultados para "{{ $query }}"</p>
@endif
</div>
</x-app-layout>