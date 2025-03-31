@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Documentos')
@section('content')
<style>
.card-doc {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card-doc:hover {
    transform: scale(1.05); /* Aumenta el tamaño en un 5% */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Agrega sombra para resaltar */
}
.container {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    border: none;
}
.img-doc {
  width: 100px; 
  height: auto; 
  object-fit: cover; /* La imagen se ajusta sin deformarse */
  border-top-left-radius: 5px; 
  border-bottom-left-radius: 5px; 
  margin: 10px;
}
</style>
<div class="container mt-4">
  <h2 class="text-center mb-4" style="color: #752e0f">Documentos</h2>
    @foreach ($documentos as $documento)
    <a href="{{ route('documentos.show', $documento->slug) }}" class="card mb-3 card-doc" style="max-width: 540px; text-decoration: none;">
      <div class="d-flex flex-row">
        <div class="col"> 
        <img src=" {{ asset('catedra/documento.png')}}" alt="documento imagen" class="img-doc">
        </div>
        <div class="col-lg-8">
          <div class="card-body">
            <h5 class="card-title">{{ Str::limit($documento->titulo, 50) }}</h5>
            <p class="card-text">
              {{ Str::limit(html_entity_decode(strip_tags($documento->descripcion)), 100) }}
          </p>
          </div>
        </div>
      </div>
    </a>
    @endforeach
          <!--paginacion-->
          <div class="d-flex justify-content-center mt-4">
            {{ $documentos->links() }}
        </div>
  </div>
@endsection