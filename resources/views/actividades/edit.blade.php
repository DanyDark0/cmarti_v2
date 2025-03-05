@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Actividad</h1>

    <form action="{{ route('actividades.update', $actividad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('actividades.form') <!-- Reutilizamos el formulario -->

        <button type="submit" class="btn btn-primary mt-3">Actualizar Actividad</button>
    </form>

    <a href="{{ route('actividades.admin') }}" class="btn btn-secondary mt-3">Cancelar</a>
</div>
@endsection
