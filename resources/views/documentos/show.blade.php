@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Documentos')
@section('content')
<style>
.content {
    text-align: justify; /* Justifica el texto */
    background-color: #ffffff; /* Color beige claro para el fondo */
    margin: 20px 0; /* Espacio arriba y abajo */
    border-radius: 10px; /* Bordes redondeados */
}

.title {
    color: #6F4E37; /* Color café para el título */
    font-weight: bold;
    text-align: center;
    display: inline-block;
    margin-bottom: 15px;
    hyphens: auto;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
    max-width: 600px;
    width: 100%;
    white-space: normal; /* Permitimos el salto de línea */
}
.pdf-viewer {
    width: 100%;
    max-width: 800px;
    height: 500px;
    border: 1px solid #ccc;
    margin-top: 10px;
}
</style>

<div class="flex-grow-1 px-3 mt-4 text-center">
    <h2 class="title">Detalles del Documento</h2>
    <div class="content">

    <!-- Mostrar título -->
    <div class="mb-3">
        <label for="titulo" class="form-label fw-bold">Título</label>
        <p id="titulo">{{ $documento->titulo }}</p>
    </div>

    <!-- Mostrar descripción -->
    <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripcion</label>
        <p> {!! $documento->descripcion !!} </p>
    </div>

    <!-- Mostrar archivo doc1 -->
    <div class="mb-3">
        <label for="doc1" class="form-label fw-bold">Documentos</label>
        @if ($documento->doc1)
        @php
            $extension1 = pathinfo($documento->doc1, PATHINFO_EXTENSION);
        @endphp
        @if (strtolower($extension1) === 'pdf')
            <div>
                <canvas id="previewDoc1" class="border" width="150" height="200"></canvas>
            </div>
        @endif
        <a href="{{ asset($documento->doc1) }}" onclick="return manejarArchivo(event, '{{ asset($documento->doc1) }}')" class="btn btn-link">Ver {{ basename($documento->doc1) }}</a>
        @endif
    </div>

    <!-- Mostrar archivo doc2 -->
    <div class="mb-3">
        @if ($documento->doc2)
        @php
            $extension2 = pathinfo($documento->doc2, PATHINFO_EXTENSION);
        @endphp
        @if (strtolower($extension2) === 'pdf')
            <div>
                <canvas id="previewDoc2" class="border" width="150" height="200"></canvas>
            </div>
        @endif
        <a href="{{ asset($documento->doc2) }}" onclick="return manejarArchivo(event, '{{ asset($documento->doc2) }}')" class="btn btn-link">Ver {{ basename($documento->doc2) }}</a>
        @endif
    </div>

    <!-- Botón para volver -->
    <a href="{{ route('documentos') }}" class="btn btn-secondary">Volver</a>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
function manejarArchivo(event, url) {
    let extension = url.split('.').pop().toLowerCase();
    if (extension === 'pdf') {
        event.preventDefault();
        window.open(url, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
    }
}

// Función para renderizar la primera página del PDF en un canvas
function renderPDF(url, canvasId) {
    let canvas = document.getElementById(canvasId);
    let ctx = canvas.getContext('2d');

    pdfjsLib.getDocument(url).promise.then(pdf => {
        return pdf.getPage(1);
    }).then(page => {
        let viewport = page.getViewport({ scale: 0.5 });
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        let renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };
        return page.render(renderContext);
    }).catch(error => {
        console.error("Error cargando el PDF:", error);
    });
}

// Cargar vista previa si los documentos existen
@if ($documento->doc1)
    renderPDF("{{ asset($documento->doc1) }}", "previewDoc1");
@endif

@if ($documento->doc2)
    renderPDF("{{ asset($documento->doc2) }}", "previewDoc2");
@endif
</script>
@endsection