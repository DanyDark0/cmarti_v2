<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Lista de Usuarios</h1>
    
        <a href="{{ route('usuarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Nuevo Usuario</a>
    
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Nombre</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            <a href="{{ route('usuarios.show', $user->id) }}" class="text-blue-500">Ver</a>
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="text-yellow-500 ml-2">Editar</a>
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
