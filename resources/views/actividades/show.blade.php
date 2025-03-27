@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Actividades')
@section('content')

<style>
.img-fluid {
width: 400px;
max-width: 100%;
height: auto;
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
    color: #000000;
    background-color: #b3833f;
    border: none;
}
.btn:hover {
    background-color: #db9167;
}
.content {
    text-align: justify; /* Justifica el texto */
    background-color: #ffffff; /* Color beige claro para el fondo */
    padding: 20px; /* Espaciado interno */
    margin: auto; /* Espacio arriba y abajo */
    max-width: 100%;
    overflow-wrap: break-word;
}

.title {
    color: #6F4E37; /* Color café para el título */
    font-weight: bold;
    display: inline-block;
    margin-bottom: 15px;
    hyphens: auto;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
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
    <h1 class="title">{{ $actividad->titulo }}</h1>
    <div class="content">
    <!-- Imágenes -->
    <div class="text-center my-4">
        @if($actividad->url_img1)
            <img src="{{ asset($actividad->url_img1) }}" alt="Imagen 1" class="img-fluid rounded mb-3">
        @endif
        @if($actividad->url_img2)
            <img src="{{ asset($actividad->url_img2) }}" alt="Imagen 2" class="img-fluid rounded">
        @endif
    </div>
    
    <!-- Separador -->
    <hr>
    
    <!-- Descripción -->
    <div class="mb-4">
        <p>{!! $actividad->descripcion !!}</p>
    </div>

    <!-- Fecha de Publicación -->
    <div class="date-content">
        <p class="fecha-publicacion"><strong>Fecha de Publicación:</strong> {{ $actividad->fecha }}</p> 
    </div>

    <!-- Separador -->
    <hr>
    
        <!-- Archivos -->
        <div>
            @if($actividad->archivo1 || $actividad->archivo2)
                <h3>Archivos Adjuntos</h3>
                <ul class="list-unstyled">
                    @if($actividad->archivo1)
                        <li><a href="{{ asset($actividad->archivo1) }}" target="_blank">Descargar {{ basename($actividad->archivo1) }}</a></li>
                    @endif
                    @if($actividad->archivo2)
                        <li><a href="{{ asset($actividad->archivo2) }}" target="_blank">Descargar {{ basename($actividad->archivo2) }}</a></li>
                    @endif
                </ul>
            @endif
        </div>
        
        <!-- Botón de regreso -->
        <a href="{{ route('actividades') }}" class="btn btn-primary mt-3">Volver</a>
    </div> 
</div>
    
@endsection