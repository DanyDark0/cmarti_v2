@extends('layouts.app')

@section('content')

<style>
  .content {
    text-align: justify; /* Justifica el texto */
    background-color: #ffffff; /* Color beige claro para el fondo */
    border-left: 5px solid #6F4E37; /* Borde lateral café */
    padding: 20px; /* Espaciado interno */
    margin: 20px 0; /* Espacio arriba y abajo */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

.title {
    color: #6F4E37; /* Color café para el título */
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
}
</style>


<div class="container mt-5">
    <h1 class="title text-center">{{ $actividad->titulo }}</h1>
    <div class="content">
    <!-- Imágenes -->
    <div class="text-center my-4">
        @if($actividad->url_img1)
            <img src="{{ asset('storage/' . $actividad->url_img1) }}" alt="Imagen 1" class="img-fluid rounded mb-3" style="max-width: 400px; height: auto; margin: auto;">
        @endif
        @if($actividad->url_img2)
            <img src="{{ asset('storage/' . $actividad->url_img2) }}" alt="Imagen 2" class="img-fluid rounded" style="max-width: 400px; height: auto; margin: auto;">
        @endif
    </div>
    
    <!-- Separador -->
    <hr>
    
    <!-- Descripción -->
    <div class="mb-4">
        <h3>Descripción</h3>
        <p>{!! $actividad->descripcion !!}</p>
    </div>

        <!-- Separador -->
        <hr>
    
    <!-- Archivos -->
    <div>
        <h3>Archivos Adjuntos</h3>
        <ul>
            @if($actividad->archivo1)
                <li><a href="{{ asset('storage/' . $actividad->archivo1) }}" target="_blank">Descargar Archivo 1</a></li>
            @endif
            @if($actividad->archivo2)
                <li><a href="{{ asset('storage/' . $actividad->archivo2) }}" target="_blank">Descargar Archivo 2</a></li>
            @endif
        </ul>
    </div>
</div> 
    
    <!-- Botón de regreso -->
    <a href="{{ route('actividades') }}" class="btn btn-primary mt-3">Volver</a>
</div>
    
@endsection