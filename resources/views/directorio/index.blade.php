@extends('layouts.app')

@section('content')
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

.card-body-dir {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}
</style>

<div class="container">
    <h2 class="text-center mb-4">Directorio</h2>
        @php
            $ordenCatedras = [
                'Coordinador',
                'Asistente de coordinación',
                'Comité Técnico',
                'Comité Honorifico',
                'Colaboradores'
            ];
        @endphp
    <div class="row justify-content-center">
        @foreach ($ordenCatedras as $catedra)
            @php
                $directorioFiltrado = $directorio->where('catedra', $catedra);
            @endphp

            @if ($directorioFiltrado->count() > 0)
                <div class="col-12 my-3">
                    <h3 class="text-center text-white py-2"  style="background-color: #752e0f; border-radius: 3px;">{{ $catedra }}</h3>
                </div>

                @foreach ($directorioFiltrado as $persona)
                    <div class="col-md-4 mb-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body-dir text-center">
                                            <p>
                                                <img class="img-fluid rounded-circle" 
                                                    src="{{ asset('storage/' . $persona->imagen) }}" 
                                                    alt="Imagen de {{ $persona->nombre }}" 
                                                    width="120" height="120">
                                            </p>
                                            <h4 class="card-title">{{ $persona->nombre }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body-dir text-center">
                                            <h2 class="card-title">Teléfono</h2>
                                            <p class="card-text">{{ $persona->telefono ?? 'No disponible' }}</p>
                                            <h2 class="card-title">Correo</h2>
                                            <p class="card-text">{{ $persona->correo ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
@endsection
