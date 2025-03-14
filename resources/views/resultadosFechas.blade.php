@extends('layouts.userapp')

@section('content')
<style>
    a {
        text-decoration: none;
        color: inherit;
    }
    .card {
        border: none;
        overflow: hidden;
    }
    .card-body-search {
        background: linear-gradient(to right, #e0b883, #9b5025);
        padding: 20px; 
        border-radius: 10px;
    }
</style>
<div class="container">
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
                        {{ Str::limit($resultado->titulo, 50, '...') }}                   
                </h4>
                <p class="card-text">{!! Str::limit($resultado->descripcion, 200, '...') !!}</p>
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