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

.image-flip:hover .backside,
.image-flip.hover .backside {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
    border-radius: .25rem;
}

.image-flip:hover .frontside,
.image-flip.hover .frontside {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform: perspective(1000px);
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
}

.backside {
    position: absolute;
    top: 0;
    left: 0;
    background: white;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    /* box-shadow: 5px 7px 9px -4px rgb(158, 158, 158); */
}

.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-height: 312px;
    min-width: 312px;
}

.backside .card a {
    font-size: 18px;
    color: #752e0f!important;
}

.frontside .card .card-title,
.backside .card .card-title {
    color: #752e0f !important;
}

.frontside .card .card-body img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
}

.mainflip {
    width: 100%;
    height: 100%;
    position: relative;
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
