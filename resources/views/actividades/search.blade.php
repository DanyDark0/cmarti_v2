@extends('layouts.userapp')

@section('content')
<style>
    .container-act {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #f8f9fa; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
}
.card-act {
    border-right: 5px solid #752e0f;/* Borde lateral café */
    height: 100%; /* Para que todas las tarjetas tengan la misma altura */
    width: 100;
    max-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #752e0f;
    border-radius: 8px;
    overflow: hidden;
}

.card-body-act {
    background-color: #d8910b
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
}

.card-title-buscador {
    color: antiquewhite;
    font-size: 1.2rem;
    font-weight: bold;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
}

.card-text {
    color: antiquewhite;
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    font-size: 0.9rem;
}

.card-img-top-act {
    width: 100%;
    aspect-ratio: 1 / 1; /* Mantiene la imagen cuadrada */
    object-fit: cover; /* Asegura que la imagen se recorte sin deformarse */
}

.boton-act {
    background-color: #d8910b;
}

.boton-act:hover {
    background-color: #e19d65;
}
</style>
<div class="container-act mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #752e0f">Resultados de la búsqueda</h2>
        
        <!-- Buscador -->
        <form action="{{ route('actividades.buscar') }}" method="POST" class="d-flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar actividades..." class="form-control me-2">
            <button type="submit" class="btn" style="background-color: #752e0f color: #e19d65">Buscar</button>
        </form>
    </div>

    @if($actividades->isEmpty())
        <p class="text-center">No se encontraron resultados.</p>
    @else
        <div class="row-4">
            @foreach($actividades as $actividad)
                <div class="col-md-4 mb-4">
                    <div class="card-act">
                        <img src="{{ $actividad->url_img1 ? asset($actividad->url_img1) : asset('./catedra/Jose-Marti.jpg') }}" class="card-img-top-act" alt="Imagen de actividad">
                        <div class="card-body-act">
                            <h5 class="card-title-buscador">{{ $actividad->titulo }}</h5>
                            <div class="card-text">{!! Str::limit($actividad->descripcion, 100) !!}</div>
                            <a href="{{ route('actividades.show', $actividad->slug) }}" class="btn boton-act">Ver más</a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Paginación -->
    <div class="mt-4">
        {{ $actividades->appends(['keyword' => request('keyword')])->links() }}
    </div>
</div>
@endsection
