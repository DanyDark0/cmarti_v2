@extends('layouts.app')

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

.boton-act {
    background-color: #d8910b;
}

.boton-act:hover {
    background-color: #e19d65;
}



</style>
<div class="container-act mt-4">
    <div class="row">
        @foreach($actividades as $actividad)
            <div class="col-md-3 mb-4">
                <div class="card-act mb-4">
                    <img src="{{ $actividad->url_img1 ? asset('storage/' . $actividad->url_img1) : asset('./storage/image/Jose-Marti.jpg') }}" class="card-img-top-act" alt="Imagen de actividad">
                    <div class="card-body-act">
                        <h5 class="card-title-act">{{ $actividad->titulo }}</h5> <!-- Mostrar título -->
                        <p class="card-text-act">{!! $actividad->descripcion_truncado !!}</p> <!-- Mostrar descripción -->
                        <a href="{{ route('actividades.show', $actividad->id) }}" class="boton-act btn">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!--paginacion-->
    <div class="d-flex justify-content-center mt-4">
        {{ $actividades->links() }}
    </div>
</div>
@endsection