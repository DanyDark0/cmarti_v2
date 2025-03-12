@extends('layouts.userapp')

@section('content')
<div class="container">
    <h2>Detalles del Documento</h2>

    <!-- Mostrar título -->
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <p type="text" class="form-control" id="titulo">{{ $documento->titulo }}</p>
    </div>

    <!-- Mostrar descripción -->
    <div class="mb-3">
        <p type="text" class="form-control" id="descripcion">{{ $documento->descripcion }}</p>
    </div>

    <!-- Mostrar archivo doc1 -->
    <div class="mb-3">
        <label for="doc1" class="form-label">Documento 1</label>
        @if ($documento->doc1)
            <a href="{{ asset('storage/' . $documento->doc1) }}" target="_blank" class="btn btn-link">Ver {{ basename($documento->doc1)}}</a>
        @endif
    </div>

    <!-- Mostrar archivo doc2 -->
    <div class="mb-3">
        <label for="doc2" class="form-label">Documento 2</label>
        @if ($documento->doc2)
            <a href="{{ asset('storage/' . $documento->doc2) }}" target="_blank" class="btn btn-link">Ver {{ basename($documento->doc2)}}</a>
        @endif
    </div>

    <!-- Botón para volver -->
    <a href="{{ route('documentos') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
