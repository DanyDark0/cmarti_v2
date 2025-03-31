@extends('layouts.userapp')


@section('content')
<style>
  .custom-card {
    background-color: #e6b168;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Distribuye el contenido de manera equilibrada */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
    min-width: 200px; /* Evita que las tarjetas se hagan demasiado pequeñas */
    max-width: 300px; /* Evita que crezcan demasiado en pantallas grandes */
    height: 100%; /* Asegura que todas tengan la misma altura */
  }


  .custom-card-img-top {
    aspect-ratio: 1/1;
    width: 100%;
    height: auto;
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

    .col-noticia{
    display: flex;
    justify-content: center;
    }

/* Nuevas reglas para las columnas */
@media (max-width: 576px) {
    .col-noticia {
        flex: 0 0 100%; /* Para mostrar 1 tarjeta por fila en móviles */
        max-width: 100%;
    }
}

</style>
@if (session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

<div class="container mt-4">
    <h2 class="mb-4 text-center">Noticias</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 px-3 py-5">
      @foreach ($noticias as $noticia)
    
      <div class="col col-noticia">
          <div class="custom-card h-100">
              <!-- Mostrar solo la primera imagen de la noticia -->
              <img src="{{ $noticia->url_img1 ? asset($noticia->url_img1) : ($noticia->url_img2 ? asset($noticia->url_img2) : asset('./catedra/Jose-Marti.jpg')) }}"  class="custom-card-img-top" alt="Imagen de noticia">
              <div class="card-body">
                  <h5 class="card-title">{{ $noticia->titulo }}</h5> 
                  <hr>
                  <p class="card-text">{!! strip_tags(Str::limit($noticia->descripcion, 400, '...')) !!}</p> 
              </div>
              <a href="{{ route('actividades.show', $noticia->slug) }}" class="boton-act btn">Ver más</a>
          </div>
      </div>
  @endforeach
    </div>
  </div>

  <div class="container flex-grow mt-5 mb-5">
    <h2 class="text-center mb-4">Eventos por año</h2>
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
          <div class="row justify-content-center">
          <div class="col-md-1 mt-3">
              <button  style="color: black; background-color: #c47a3d; border: none;" type="submit" class="btn btn-primary">Buscar</button>
          </div>
          </div>
      </div>
  </form>
</div>

  @endsection
 