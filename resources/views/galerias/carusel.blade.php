@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Galerias')
@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #752e0f">Galerias</h2>

    @foreach ($galerias as $galeria)
    <div class="card h-100 shadow-lg">
        <h3 class="card-title text-center fs-3 fw-semibold mb-4">{{ $galeria->titulo }}</h3>
        <div class="card-body d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-center justify-content-md-between gap-4">

            @if ($galeria->fotos->count() > 0)
            <div class="w-100 w-md-50 d-flex justify-content-center">
                <div id="carousel{{ $galeria->id }}" class="carousel slide w-100 shadow-lg rounded overflow-hidden" data-bs-ride="carousel" style="max-width: 400px;">
                    <div class="carousel-inner" style="height: 300px; overflow: hidden; aspect-ratio: 1;">
                        @foreach ($galeria->fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <a href="{{ asset('storage/galeria/' . $foto->url_imagen) }}" data-lightbox="galeria{{ $galeria->id }}" data-title="{{ $galeria->titulo }}">
                                <img src="{{ asset('storage/galeria/' . $foto->url_imagen) }}" class="d-block w-100 h-100 object-fit-cover rounded" alt="Imagen de galería">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $galeria->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $galeria->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
            @else
                <p class="text-center text-muted">No hay imágenes en esta galería.</p>
            @endif
            <div class="w-100 w-md-50">
                <p>{{ $galeria->descripcion }}</p>
            </div>
        </div>
    </div>
@endforeach

    <div class="d-flex justify-content-center">
        {{ $galerias->links() }}
    </div>
</div>
@endsection