@extends('layouts.userapp')

@section('content')
<style>

.container-act {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #f8f9fa; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
}
.card-act {
    height: 100%; /* Para que todas las tarjetas tengan la misma altura */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #752e0f;
    border-radius: 8px;
    overflow: hidden;
}

.card-body-act {
    background-color: #d8910b
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
}

.card-title-act {
    color: antiquewhite;
    font-size: 1.2rem;
    font-weight: bold;
}

.card-text-act {
    color: antiquewhite;
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    font-size: 0.9rem;
}

.card-img-top-act {
    width: 100%;
    aspect-ratio: 1 / 1; /* Mantiene la imagen cuadrada */
    object-fit: cover; /* Asegura que la imagen se recorte sin deformarse */
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.boton-act{
    background-color: #d8910b;
}


</style>
<div class="container busqueda-container mt-5 pt-5">
    <h1>Resultados de búsqueda: {{ $query }}</h1>
    <h6>{{ $totalResultados }} coincidencias</h6>

    @if($totalResultados > 0)
        @if(!$resultados['actividades']->isEmpty())
            <h2>Actividades</h2>
            @foreach($resultados['actividades'] as $actividad)
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('actividades.show', $actividad->slug) }}">
                                <h6>{{ $actividad->titulo }}</h6>
                            <p>{!! $actividad->descripcion_truncado !!}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

        @if(!$resultados['documentos']->isEmpty())
            <h2>Documentos</h2>
            @foreach($resultados['documentos'] as $documento)
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('documentos.show', $documento->slug) }}">
                            <h6>{{ $documento->titulo }}</h6>
                        <p>{!! $documento->descripcion_truncado !!}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

        @if(!$resultados['convocatorias']->isEmpty())
            <h2>Convocatorias</h2>
            @foreach($resultados['convocatorias'] as $convocatoria)
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('convocatorias.show', $convocatoria->slug) }}">
                                <h6>{{ $convocatoria->titulo }}</h6>
                            <p>{!! $convocatoria->descripcion_truncado !!}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <p>No se encontraron resultados.</p>
    @endif
</div>

    <!--paginacion-->
    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $actividades->links() }}
    </div>  --}}
</div>
@endsection