@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Resultados por Fecha')
@section('content')
<style>
    a {
        text-decoration: none;
        color: inherit;
    }
    .card {
        border-color: black;
        overflow: hidden;
    }
    .card-body-search {
        padding: 20px; 
        border-radius: 10px;
    }
    /* Ajuste para que el contenido no desborde el flex container */
    .flex-grow-1 {
        min-width: 0;
        overflow-x: hidden;
    }
</style>
<div class="flex-grow-1 px-3 mt-4 text-center">
    <h2 class="text-center">Resultados para el año {{ $year }}</h2>

    <h3 class="mt-4">Resultados</h3>
@if ($resultadosPaginados->isEmpty())
    <p>No hay registros para este año.</p>
@else
    @foreach ($resultadosPaginados as $resultado)
        <div class="card my-3">
            <a href="{{ route($resultado instanceof \App\Models\Actividad ? 'actividades.show' : 'convocatorias.show', $resultado->slug) }}"> 
            <div class="card-body-search">
                <h4 class="card-title">
                        {{ Str::limit($resultado->titulo, 100, '...') }}                   
                </h4>
                <p class="card-text">{!! Str::limit($resultado->descripcion, 100, '...') !!}</p>
                <small class="text-muted">{{ $resultado->fecha }}</small>
            </div>
        </a>
        </div>
    @endforeach

    {{ $resultadosPaginados->links() }}
    @endif

    <a href="{{ route('welcome') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection