@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Actividades')
@section('content')
<style>
    
.container-act {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
}
.card-act {
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
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
}

.card-title-act {
    text-align: center; /* Centra el texto */
    color: antiquewhite;
    font-size: 1.2rem;
    font-weight: bold;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Máximo 2 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    min-height: 3rem; /* Ajusta la altura mínima según el tamaño de la fuente */
    word-wrap: break-word;
}

.card-text-act {
    text-align: justify;
    color: antiquewhite;
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    font-size: 1rem;
    word-wrap: break-word;
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
    <h2 class="text-center mb-4" style="color: #752e0f">Actividades</h2>
     {{-- Formulario de buscador exclusivo de actividades --}}
    <div class="d-flex justify-content-end align-items-center mb-4">
        <form action="{{ route('actividades.buscar') }}" method="POST" class="d-flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar actividades..." class="form-control me-2">
            <button type="submit" class="btn" style="background-color: #752e0f color: #e19d65">Buscar</button>
        </form>
    </div>
    {{-- contenido del index --}}
    <div class="row">
        @foreach($actividades as $actividad)
            <div class="col-md-4 mb-5 d-flex justify-content-center">
                <div class="card-act mb-4">
                    <img src="{{ $actividad->url_img1 ? asset($actividad->url_img1) : ($actividad->url_img2 ? asset($actividad->url_img2) : asset('./catedra/Jose-Marti.jpg')) }}" class="card-img-top-act" alt="Imagen de actividad">
                    <div class="card-body-act">
                        <h5 class="card-title-act">{{ $actividad->titulo }}</h5> <!-- Mostrar título -->
                        <p class="card-text-act">{{ html_entity_decode(strip_tags($actividad->descripcion)) }}</p> <!-- Mostrar descripción -->
                        <a href="{{ route('actividades.show', $actividad->slug) }}" class="boton-act btn">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!--paginacion-->
    <div class="d-flex justify-content-center mt-4">
        {{ $actividades->links() }}
    </div>
</div>
@endsection