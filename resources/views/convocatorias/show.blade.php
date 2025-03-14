@extends('layouts.userapp')

@section('content')
<style>
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
    padding: 20px; /* Espaciado interno */
    margin: 20px 0; /* Espacio arriba y abajo */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 3px 3px 10px #752e0f; /* Sombra suave */
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
</style>
<div class="container mt-5" style="text-align: center">
    <h1 class="title">{{ $convocatorias->titulo }}</h1>
    <div class="content">
 

                <!-- Separador -->
                <hr>
                <!-- Imágenes -->
                <div class="text-center my-4">
                    @if($convocatorias->url_img1)
                        <img src="{{ asset($convocatorias->url_img1) }}" alt="Imagen 1" class="img-fluid rounded mb-3" style="max-width: 400px; height: auto; margin: auto;">
                    @endif
                    @if($convocatorias->url_img2)
                        <img src="{{ asset($convocatorias->url_img2) }}" alt="Imagen 2" class="img-fluid rounded" style="max-width: 400px; height: auto; margin: auto;">
                    @endif
                </div>
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
                    <a href="{{ asset( $convocatorias->archivo1) }}" download>
                        {{ basename($convocatorias->archivo1) }}
                    </a>
                    @endif
                    @if ($convocatorias->archivo2)
                    <a href="{{ asset( $convocatorias->archivo2) }}" download>
                        {{ basename($convocatorias->archivo2) }}
                    </a>
                    @endif
            </div>



    <a href="{{ route('convocatorias') }}" class="btn mt-3">Volver</a>
</div>
</div>
@endsection
