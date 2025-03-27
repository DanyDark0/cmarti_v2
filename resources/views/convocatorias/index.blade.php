@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Convocatorias')
@section('content')
<style>

.container-act {
    color: #752e0f;
    margin: 40px auto; /* Margen superior e inferior de 40px y centrado horizontal */
    padding: 20px; /* Espaciado interno */
    max-width: 1200px; /* Limita el ancho del contenedor */
    background-color: #ffffff; /* Color de fondo ligero */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
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
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
}

.card-title-act {
    text-align: center; /* Centra el texto */
    color: antiquewhite;
    font-size: 1.2rem;
    font-weight: bold;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Máximo 2 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    min-height: 3rem; /* Ajusta la altura mínima según el tamaño de la fuente */
    word-wrap: break-word;
}

.card-text-act {
    color: antiquewhite;
    flex-grow: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Máximo 4 líneas */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    font-size: 1rem;
    word-wrap: break-word;
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
<script>
    let errorMessages = `
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                `;

    Swal.fire({
                title: 'Espera...',
                html: errorMessages,
                icon: 'error',
                position: 'top-end', // Coloca la alerta en la esquina superior derecha
                showConfirmButton: false, // Oculta el botón de 'OK'
                timer: 1500,
                timerProgressBar: true,
                backdrop: false, // No oscurece la pantalla
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal-popup', 
                    title: 'swal-title', 
                    text: 'swal-text',
                },
            });
</script>
@endif
<div class="container-act mt-4">
    <h2 class="text-center mb-4">Convocatorias</h2>
    {{-- Formulario de busqueda para convocatorias --}}
    <div class="d-flex justify-content-end align-items-center mb-4">
        <form action="{{ route('convocatorias.buscar') }}" method="POST" class="d-flex mb-4">
            @csrf
            <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar convocatorias..." class="form-control me-2">
            <button type="submit" class="btn" style="background-color: #752e0f color: #e19d65">Buscar</button>
        </form>
    </div>
    {{-- contenido del index --}}
    <div class="row">
        @foreach($convocatorias as $convocatoria)
            <div class="col-md-4 mb-5 d-flex justify-content-center">
                <div class="card-act mb-4">
                    <img src="{{ $convocatoria->url_img1 ? asset($convocatoria->url_img1) : ($convocatoria->url_img2 ? asset($convocatoria->url_img2) : asset('./catedra/Jose-Marti.jpg')) }}" 
                    class="card-img-top-act" 
                    alt="Imagen de convocatoria">
                    <div class="card-body-act">
                        <h5 class="card-title-act">{{ $convocatoria->titulo }}</h5> <!-- Mostrar título -->
                        <p class="card-text-act">{!! $convocatoria->descripcion_truncado !!}</p> <!-- Mostrar descripción -->
                        <a href="{{ route('convocatorias.show', $convocatoria->slug) }}" class="boton-act btn">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!--paginacion-->
    <div class="d-flex justify-content-center mt-4">
        {{ $convocatorias->links() }}
    </div>
</div>
@endsection