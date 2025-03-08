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
  .custom-card {
    background-color: #e6b168;
    margin: 20px; /* Márgenes externos */
    border-radius: 8px; /* Bordes redondeados */
    height: 100%; /* Hace que todas las tarjetas tengan la misma altura */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }


  .custom-card-img-top {
    aspect-ratio: 1/1;
    width: 100%;
    object-fit: cover; /* Mantiene la proporción de la imagen sin distorsionarla */
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
  
  .custom-card .card-body {

    padding: 15px; /* Ajusta el padding del contenido */
  }
  
  .card-body {
    flex-grow: 1; /* Permite que el contenido de la tarjeta se expanda */
    display: flex;
    flex-direction: column;
    justify-content: center;
}

  .card-color {
    background-color: #c47a3d;
  } 
  .card-title {
    color: black;
  }
  .card-text {
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Limita el texto a 4 líneas */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis; /* Añade "..." si el texto es muy largo */
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    text-align: left; /* O usa text-align: start; */
    font-size: 1.2rem; /* Ajusta según necesidad */
    line-height: 1.6; 
}

  .boton-act {
    align-self: flex-start; /* Alinea el botón correctamente */
    background-color: #6F4E37; /* Color café */
    color: white; /* Letras blancas */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
    display: inline-block;
}

.boton-act:hover {
    background-color: #A67B5B; /* Un café más claro */
    color: white;
    transform: scale(1.05); /* Efecto de agrandar ligeramente */
}

</style>

<div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 text-center">Noticias</h2>
    <div class="content row row-cols-1 row-cols-lg-4 align-items-stretch g-4 py-5">
      @foreach ($noticias as $noticia)
      
      <div class="col-md-3 mb-4 mx-2">
          <div class="custom-card mb-4">
              <!-- Mostrar solo la primera imagen de la noticia -->
              @if ($noticia->url_img1)
                  <img src="{{  asset($noticia->url_img1) }}" class="custom-card-img-top" alt="Imagen de noticia">
              @else
                  <img src="{{ asset('./storage/image/Jose-Marti.jpg') }}" class="custom-card-img-top" alt="Imagen por defecto">
              @endif
              <div class="card-body">
                  <h5 class="card-title">{{ $noticia->titulo }}</h5> 
                  <p class="card-text">{!! strip_tags(Str::limit($noticia->descripcion, 300, '...')) !!}</p> 
                  <a href="{{ route('actividades.show', $noticia->id) }}" class="boton-act btn">Ver más</a>
              </div>
          </div>
      </div>
  @endforeach
    </div>
  </div>



  @endsection
 