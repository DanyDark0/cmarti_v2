@extends('layouts.userapp')

@section('content')
<style>
.container {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    border: none;
}
</style>
<div class="container mt-4">
  <h2 class="text-center mb-4" style="color: #752e0f">Documentos</h2>
    @foreach ($documentos as $documento)
    <a href="{{ route('documentos.show', $documento->slug) }}" class="card mb-3 d-block" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ $documento->titulo }}</h5>
            <p class="card-text" style="color:#ed3131">
                {{ $documento->descripcion }}
            </p>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
@endsection