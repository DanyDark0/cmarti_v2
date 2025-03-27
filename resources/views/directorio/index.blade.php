@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Directorio')
@section('content')
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

/* .card-body-dir {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
} */
.container {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    border: none;
}

.card-title {
    color: #752e0f;
}
.card-dir {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 250px;
    min-height: 300px;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: white;
}

.card-dir img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.card-dir h4 {
    font-size: 18px;
    margin: 10px 0;
    color: #752e0f;
}

.card-dir p {
    font-size: 14px;
    margin: 5px 0;
    color: #555;
}
</style>

<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #752e0f">Directorio</h2>
        @php
            $ordenCatedras = [
                'Coordinador',
                'Asistente de coordinación',
                'Comité Técnico',
                'Comité Honorifico',
                'Colaboradores'
            ];
        @endphp
    <div class="row justify-content-center">
        @foreach ($ordenCatedras as $catedra)
            @php
                $directorioFiltrado = $directorio->where('catedra', $catedra);
            @endphp

            @if ($directorioFiltrado->count() > 0)
                <div class="col-12 my-3">
                    <h3 class="text-center text-white py-2 mb-2"  style="background-color: #752e0f; border-radius: 3px;">{{ $catedra }}</h3>
                </div>

                @foreach ($directorioFiltrado as $persona)
                <div class="col-md-3 mb-4 d-flex justify-content-center">
                    <div class="card-dir">
                            <p>
                                <img class="img-fluid rounded-circle" 
                                    src="{{ $persona->imagen ? asset( $persona->imagen) : asset('catedra/Jose-Marti.jpg') }}" 
                                    alt="Imagen de {{ $persona->nombre }}">
                            </p>
                            <h2 class="card-title mb-2">{{ $persona->nombre }}</h2>
                            @if (!empty($persona->telefono))
                                <h5>Teléfono</h5>
                                <p class="card-text">{{ $persona->telefono }}</p>
                            @endif
                            @if (!empty($persona->correo))
                                <h5>Correo</h5>
                                <p class="card-text">{{ $persona->correo }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
@endsection
