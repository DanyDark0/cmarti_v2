<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Administración de Convocatorias</h1>

        <!-- Botón para crear nueva convocatoria -->
        <a href="{{ route('convocatorias.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            <button>Nueva Convocatoria</button>
        </a>

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
                                    <form action="{{ route('convocatorias.destroy', $convocatoria->slug) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta convocatoria?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center mt-6">
            {{ $convocatorias->links() }}
        </div>
    </div>
</x-app-layout>
