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
    display: flex;
    flex-wrap: wrap;
    gap: 10px; 
}
  .custom-card {
    background-color: #e6b168;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Distribuye el contenido de manera equilibrada */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
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
    padding-bottom: 30px;
}

  .card-color {
    background-color: #c47a3d;
  } 
  .card-title {
    text-align: center; /* Centra el texto */
    color: rgb(0, 0, 0);
    font-size: 1.4rem;
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
    font-size: 1 rem; /* Ajusta según necesidad */
    line-height: 1.4; 
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
    margin: 10px;
}

.boton-act:hover {
    background-color: #A67B5B; /* Un café más claro */
    color: white;
    transform: scale(1.05); /* Efecto de agrandar ligeramente */
}

    /* Aplica el estilo solo cuando el select está abierto */
    .custom-select {
        max-height: 35px; /* Altura normal cuando está cerrado */
        overflow-y: hidden;
    }

    /* Cuando se abre el select, limita la altura y activa el scroll */
    .custom-select:focus {
        max-height: 200px; /* Altura máxima cuando se abre */
        overflow-y: auto;
    }
/* Nuevas reglas para las columnas */
@media (min-width: 1200px) {
    .col-lg-3 {
        flex: 0 0 23%; /* Ajusta el tamaño de cada card para que se acomoden 4 en una fila */
        max-width: 23%;
    }
}

</style>

<div class="container-act mt-4">
    <h2 class="mb-4 text-center">Noticias</h2>
    <div class="content row row-cols-1 row-cols-md-2  row-cols-lg-4 g-4 py-5">
      @foreach ($noticias as $noticia)
    
      <div class="col">
          <div class="custom-card">
              <!-- Mostrar solo la primera imagen de la noticia -->
              @if ($noticia->url_img1)
                  <img src="{{  asset($noticia->url_img1) }}" class="custom-card-img-top" alt="Imagen de noticia">
              @else
                  <img src="{{ asset('./catedra/Jose-Marti.jpg') }}" class="custom-card-img-top" alt="Imagen por defecto">
              @endif
              <div class="card-body">
                  <h5 class="card-title">{{ $noticia->titulo }}</h5> 
                  <p class="card-text">{!! strip_tags(Str::limit($noticia->descripcion, 300, '...')) !!}</p> 
              </div>
              <a href="{{ route('actividades.show', $noticia->slug) }}" class="boton-act btn">Ver más</a>
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
              <select name="year" class="form-control custom-select">
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
 