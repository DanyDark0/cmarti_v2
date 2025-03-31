<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="container p-2">
        <h1 class="text-2xl font-bold my-6 text-center">Listado de Usuarios</h1>
            {{-- Formulario de buscador --}}
    <div class="flex justify-end items-center m-4">
        <form action="{{ route('usuarios.buscar') }}" method="POST" class="flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar usuarios..." class="form-input w-60 sm:w-96 p-2 border border-gray-300 rounded-md mr-2">
            <button type="submit" class="bg-gray-400 hover:text-white text-dark px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">
                Buscar
            </button>
        </form>
    </div>
    
    <a href="{{ route('usuarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 no-underline">Nuevo Usuario</a>
{{-- Mostrar el total de resultados --}}
<div class="my-4">
    <p class="text-lg font-semibold">Total de resultados: {{ $totalResultados }}</p>
</div>

{{-- Mostrar los resultados de búsqueda --}}
@if($usuarios->isNotEmpty())
<div class="overflow-x-auto">
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Nombre</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            <a href="{{ route('usuarios.show', $user->id) }}" class="text-blue-500 ml-2 no-underline text-lg font-semibold">Ver</a>
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="text-yellow-500 ml-2 no-underline text-lg font-semibold">Editar</a>
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline no-underline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2 text-lg font-semibold" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
            {{-- Paginación --}}
    <div class="pagination">
        {{ $usuarios->links() }}
    </div>
@else
    <p>No se encontraron resultados para "{{ $query }}"</p>
@endif
    </div>
</x-app-layout>
