<x-app-layout>
    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles del Usuario</h2>
    
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            <!-- Sección para mostrar el rol -->
            <p><strong>Rol:</strong> {{ $user->roles->pluck('name')->implode(', ') }}</p>
        <div class="mt-4">
            <a href="{{ route('usuarios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Volver</a>
            <a href="{{ route('usuarios.edit', $user->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700 ml-2">Editar</a>
        </div>
    </div>
</x-app-layout>>