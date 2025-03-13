@extends('layouts.userapp')


@section('content')
<style>
    .content {
    text-align: justify; /* Justifica el texto */
    background-color: #ffffff; /* Color beige claro para el fondo */
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
    min-height: 250px;
    padding-bottom: 50px;
}

  .card-color {
    background-color: #c47a3d;
  } 
  .card-title {
    text-align: center; /* Centra el texto */
    color: rgb(0, 0, 0);
    font-size: 1.7rem;
    font-weight: bold;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Máximo 2 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    min-height: 3rem; /* Ajusta la altura mínima según el tamaño de la fuente */
    word-wrap: break-word;
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
    <div class="content row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 py-5">
      @foreach ($noticias as $noticia)
    
      <div class="col">
          <div class="custom-card mb-4">
              <!-- Mostrar solo la primera imagen de la noticia -->
              @if ($noticia->url_img1)
                  <img src="{{  asset($noticia->url_img1) }}" class="custom-card-img-top" alt="Imagen de noticia">
              @else
                  <img src="{{ asset('./catedra/Jose-Marti.jpg') }}" class="custom-card-img-top" alt="Imagen por defecto">
              @endif
              <div class="card-body">
                  <h5 class="card-title">{{ $noticia->titulo }}</h5> 
                  <p class="card-text">{!! strip_tags(Str::limit($noticia->descripcion, 300, '...')) !!}</p> 
                  <a href="{{ route('actividades.show', $noticia->slug) }}" class="boton-act btn">Ver más</a>
              </div>
          </div>
      </div>
  @endforeach
    </div>
  </div>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Filtrar por Año</h2>
    <form action="{{ route('filtrar.fecha') }}" method="GET">
      @csrf
        <div class="row justify-content-center">
            <div class="col-md-4">
                <select name="year" class="form-control">
                    <option value="">Seleccione un año</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>

  @endsection
 