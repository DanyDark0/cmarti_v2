@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Convocatorias')
@section('content')
<style>
.img-fluid {
width: auto;
max-height: 100%;
height: 400px;
display: block;
margin: auto;
}


.date-content {
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100px; /* Ajusta según sea necesario */
    position: relative;
}
.fecha-publicacion {
    font-size: 16px; /* Tamaño más pequeño */
    color: gray; /* Opcional, para que se vea más sutil */
}
.btn {
    background-color: #b3833f;
}
.btn:hover {
    background-color: #db9167;
}
.content {
    text-align: justify; /* Justifica el texto */
    background-color: #ffffff; /* Color beige claro para el fondo */
    margin: 20px 0; /* Espacio arriba y abajo */
    border-radius: 10px; /* Bordes redondeados */
}

.title {
    color: #6F4E37; /* Color café para el título */
    font-weight: bold;
    text-align: center;
    display: inline-block;
    margin-bottom: 15px;
    hyphens: auto;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
    max-width: 600px;
    width: 100%;
    white-space: normal; /* Permitimos el salto de línea */
}
/* Ajuste para que el contenido no desborde el flex container */
.flex-grow-1 {
    min-width: 0;
    overflow-x: hidden;
}
@media (max-width: 768px) {
    .img-fluid {
        width: 100%; /* Hace que la imagen ocupe todo el ancho disponible */
        max-width: 100%; /* Asegura que no se desborde */
        height: auto; /* Mantiene la proporción */
    }
}
</style>
<div class="flex-grow-1 px-3 mt-4 text-center">
    <h1 class="title">{{ $convocatorias->titulo }}</h1>
    <div class="content">
 
        <!-- Imágenes -->
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 my-4">
            @if($convocatorias->url_img1)
            <a href="{{ asset($convocatorias->url_img1) }}" data-lightbox="convocatorias" data-title="Imagen 1">
                <img src="{{ asset($convocatorias->url_img1) }}" alt="Imagen 1" class="img-fluid rounded" style="max-width: 400px; height: auto;">
            </a>
            @endif
            @if($convocatorias->url_img2)
            <a href="{{ asset($convocatorias->url_img2) }}" data-lightbox="convocatorias" data-title="Imagen 2">
                <img src="{{ asset($convocatorias->url_img2) }}" alt="Imagen 2" class="img-fluid rounded" style="max-width: 400px; height: auto;">
            </a>
            @endif
        </div>
                
        <!-- Separador -->
        <hr>
        {{-- descripcion --}}
        <div class="mb-4">
            <p>{!! $convocatorias->descripcion !!}</p>
        </div>

        <!-- Fecha de Publicación -->
        <div class="date-content">
        <p class="fecha-publicacion"><strong>Fecha de Publicación:</strong> {{ $convocatorias->fecha }}</p> 
        </div>
        <!-- Separador -->
        <hr>

    <!-- Descargar archivo -->
    <div class="mb-4">                        
            @if ($convocatorias->archivo1)
            <h3>Descargar archivo:</h3>
            <ul>
                <li><a href="{{ asset( $convocatorias->archivo1) }}" download>
                {{ basename($convocatorias->archivo1) }}
            </a></li>
            @endif
            @if ($convocatorias->archivo2)
            <li><a href="{{ asset( $convocatorias->archivo2) }}" download>
                {{ basename($convocatorias->archivo2) }}
            </a></li>
            @endif
        </ul>
    </div>



    <a href="{{ route('convocatorias') }}" class="btn mt-3">Volver</a>
</div>
</div>

@endsection
