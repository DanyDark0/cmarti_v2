<x-app-layout>
    <div class="container mb-4">
        <h1>Editar Actividad</h1>
                <!-- Muestra errores generales -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
        <form action="{{ route('actividades.update', $actividad->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            @include('actividades.form') <!-- Reutilizamos el formulario -->
    
            <button type="submit" class="btn btn-primary mt-3">Actualizar Actividad</button>
        </form>
    
        <a href="{{ route('actividades.admin') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    </x-app-layout>