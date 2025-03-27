@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Convocatorias')
@section('content')
<style>
    .container-act {
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); /* Sombra ligera */
}
.card-act {
    border-right: 5px solid #752e0f;/* Borde lateral café */
    height: 100%; /* Para que todas las tarjetas tengan la misma altura */
    width: 100;
    max-width: 300px;
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

.card-title-buscador {
    color: antiquewhite;
    font-size: 1.2rem;
    font-weight: bold;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
}

.card-text {
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
}

.boton-act {
    background-color: #d8910b;
}

.boton-act:hover {
    background-color: #e19d65;
}
</style>
<div class="container-act mt-4">
        <h2 class="text-center mb-4" style="color: #752e0f">Resultados de la búsqueda de convocatorias</h2>
        <h6>{{ $totalResultados }} coincidencias</h6>
        
        <!-- Buscador -->
        <form action="{{ route('convocatorias.buscar') }}" method="POST" class="custom-search-form d-flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar convocatorias..." class="w-5 content-end form-control rounded-pill">
            <button type="submit" class="btn" style="background-color: #752e0f color: #e19d65">Buscar</button>
        </form>

    @if($convocatorias->isEmpty())
        <p class="text-center">No se encontraron resultados.</p>
    @else
        <div class="row-4">
            @foreach($convocatorias as $convocatoria)
                <div class="col-md-4 mb-4">
                    <div class="card-act">
                        <img src="{{ $convocatoria->url_img1 ? asset($convocatoria->url_img1) : asset('./catedra/Jose-Marti.jpg') }}" class="card-img-top-act" alt="Imagen de convocatoria">
                        <div class="card-body-act">
                            <h5 class="card-title-buscador">{{ $convocatoria->titulo }}</h5>
                            <div class="card-text">{!! Str::limit($convocatoria->descripcion, 100) !!}</div>
                            <a href="{{ route('convocatorias.show', $convocatoria->slug) }}" class="btn boton-act">Ver más</a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Paginación -->
    <div class="mt-4">
        {{ $convocatorias->appends(['keyword' => request('keyword')])->links() }}
    </div>
</div>
@endsection
