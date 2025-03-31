<x-app-layout>
    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Crear Usuario</h2>
    
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg" value="{{ old('name') }}" autocomplete="off">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg" value="{{ old('email') }}" autocomplete="off">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold mb-2">Seleccione un rol:</label>
                <select name="role"  
                    class="w-full sm:w-2/5 md:w-1/3 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-opacity-50" 
                    required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
            <a href="{{ route('usuarios.index') }}" class="text-gray-700 ml-4">Cancelar</a>
        </form>
    </div>

</x-app-layout>