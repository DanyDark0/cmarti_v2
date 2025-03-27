@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Galerias')
@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #752e0f">Galerias</h2>

    @foreach ($galerias as $galeria)
    <div class="card mb-5">
        <h3 class="card-title text-center">{{ $galeria->titulo }}</h3>
        <div class="card-body" style="max-width: 400px display: flex; justify-content: center; align-items: center;">

            @if ($galeria->fotos->count() > 0)
                <div id="carousel{{ $galeria->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($galeria->fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/galeria/' . $foto->url_imagen) }}" class="d-block w-100 " alt="Imagen de galería">
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
            @else
                <p class="text-center text-muted">No hay imágenes en esta galería.</p>
            @endif
        </div>
    </div>
@endforeach

    <div class="d-flex justify-content-center">
        {{ $galerias->links() }}
    </div>
</div>
@endsection