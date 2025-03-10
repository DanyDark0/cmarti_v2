<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cátedra José Martí')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

/* Ajustes del contenedor principal */
.d-flex {
    align-items: flex-start; /* Alinea contenido y menú en la parte superior */
}
/* Estilo del menú lateral */
.sidebar-menu {
    color: #752e0f;
    position: sticky;
    top: 80px; /* Ajusta según la altura del navbar */
    height: 100vh; /* Hace que el menú abarque toda la altura de la pantalla */
    overflow-y: auto; /* Permite desplazamiento si el contenido es grande */
    width: 250px; /* Fija el ancho del menú */
    flex-shrink: 0; /* Evita que el menú se reduzca en pantallas pequeñas */
    border-right: 5px solid #752e0f; /* Borde derecho café */
    border-radius: 10px;
    padding: 20px; /* Espaciado interno */
    display: flex;
    flex-direction: column;
}

.sidebar-menu ul {
    list-style: none; /* Elimina los puntos de la lista */
    padding: 0;
    margin: 0;
}

.sidebar-menu ul li {
    font-size: 18px; /* Aumenta el tamaño de la letra */
    padding: 12px 0; /* Agrega espacio arriba y abajo de cada elemento */
    letter-spacing: 1px; /* Aumenta el espacio entre las letras */
    line-height: 1.8; /* Aumenta el espacio entre líneas */
}

.sidebar-menu ul li a {
    text-decoration: none; /* Elimina el subrayado de los enlaces */
    color: #752e0f; /* Color café */
    display: block; /* Hace que los enlaces ocupen toda la línea */
    padding: 10px 15px; /* Espaciado interno para que sea más clickeable */
    transition: background 0.3s; /* Agrega un efecto suave al pasar el mouse */
}

.sidebar-menu ul li a:hover {
    background-color: #e6c4a5; /* Color de fondo cuando se pasa el mouse */
    border-radius: 4px;
}

.custom-card {
    background-color: #e6b168;
    margin: 20px; /* Márgenes externos */
    border-radius: 8px; /* Bordes redondeados */
    height: 100%; /* Hace que todas las tarjetas tengan la misma altura */
    display: flex;
    flex-direction: column;
  }
.nav-link {
    font-size: 1.2rem; /* Ajusta el tamaño */
}
.navbar-custom {
    background-color: #752e0f; 
    color: white;
}
.navbar-custom .navbar-brand,
.navbar-custom .nav-link {
    color: white;
}
.navbar-custom .nav-link:hover {
    color: #d8910b;
}

.navbar-logo {
    border-radius: 5px;
    height: 50px; /* Altura del logo */
    width: auto; /* Mantén la proporción original */
    object-fit: contain; /* Asegura que la imagen no se distorsione */
}

/* Estilo del formulario de busqueda */
.custom-search-form {
    display: flex;
    align-items: center; /* Alinea los elementos verticalmente */
    gap: 10px; /* Espaciado entre el input y el botón */
}

/* Estilo del input */
.custom-search-form .form-control {
    border-radius: 20px; /* Bordes redondeados */
    padding: 10px 15px; /* Espaciado interno */
    border: 1px solid #ced4da; /* Borde gris claro */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombras suaves */
    transition: all 0.3s ease; /* Transición suave al enfoque */
}

/* Efecto hover y focus en el input */
.custom-search-form .form-control:focus {
    border-color: #ec4e1a; /* Color verde en el borde */
    box-shadow: 0 0 8px rgba(59, 19, 180, 0.5); /* Sombras al foco */
    outline: none;
}

/* Estilo del botón */
.custom-search-form .btn {
    border-color: #e94702;
    color: black;
    background-color: #b3833f;
    border-radius: 20px; /* Bordes redondeados */
    padding: 8px 20px; /* Espaciado interno */
    transition: all 0.3s ease; /* Transición suave */
}

/* Efecto hover en el botón */
.custom-search-form .btn:hover {
    background-color: #d8910b;
    color: rgb(0, 0, 0); 
    border-color: #e94702;
}

/* Estilo general del botón toggler */
.custom-toggler {
    border: none; /* Sin borde */
    background-color: transparent; /* Fondo transparente */
    padding: 8px 12px; /* Espaciado interno */
    border-radius: 8px; /* Bordes ligeramente redondeados */
    transition: all 0.3s ease; /* Transición suave al hover */
}


/* Quitar el borde negro (outline) al hacer clic */
.custom-toggler:focus {
    outline: none; /* Elimina el contorno predeterminado */
    box-shadow: none; /* Elimina cualquier sombra que pueda aparecer */
}
/* Estilo del ícono */
.custom-toggler .navbar-toggler-icon {
    width: 25px; /* Tamaño del ícono */
    height: 3px; /* Grosor de las barras */
    background-color: #d8910b; 
    display: block;
    position: relative;
    transition: all 0.3s ease; /* Transiciones suaves */
}

/* Barras del toggler (antes y después) */
.custom-toggler .navbar-toggler-icon::before,
.custom-toggler .navbar-toggler-icon::after {
    content: '';
    width: 25px;
    height: 3px;
    background-color: #d8910b;
    border-radius: 2px;
    position: absolute;
    left: 0;
    transition: all 0.3s ease;
}

/* Posición de las barras */
.custom-toggler .navbar-toggler-icon::before {
    top: -8px; /* Barra superior */
}

.custom-toggler .navbar-toggler-icon::after {
    top: 8px; /* Barra inferior */
}

/* Animación al abrir el menú */
.custom-toggler[aria-expanded="true"] .navbar-toggler-icon {
    background-color: transparent; /* Oculta la barra central */
}

.custom-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
    transform: rotate(45deg); /* Gira la barra superior */
    top: 0;
}

.custom-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
    transform: rotate(-45deg); /* Gira la barra inferior */
    top: 0;
}

  .infoFooter {
    background-color: #222; /* Fondo oscuro para resaltar el footer */
    color: #fff; /* Texto en color blanco para contraste */
    padding: 40px 0; /* Espaciado interno */
    text-align: center; /* Centrar contenido */
}

.infoFooter .widget img {
    width: 150px; /* Tamaño del logo */
    margin-bottom: 15px; /* Espaciado entre el logo y el texto */
}

.infoFooter .widget p {
    margin: 5px 0; /* Espaciado entre párrafos */
    font-size: 14px; /* Tamaño de fuente ajustado */
}

@media (max-width: 768px) {
    .infoFooter {
        padding: 20px 10px; /* Ajuste de espaciado en pantallas pequeñas */
    }

    .infoFooter .widget img {
        width: 120px; /* Tamaño reducido del logo */
    }

    .infoFooter .widget p {
        font-size: 12px; /* Fuente más pequeña en móviles */
    }
}

    </style>
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl navbar-custom">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('storage/catedra/Jose-Marti.jpg') }}" alt="logo Universidad de Guadalajara" class="navbar-logo">
            </a>
            <a class="navbar-brand" href="{{ route('home')}}">Cátedra José Martí</a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href=" {{ Route('historia') }}">Historia</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('biografia')}}">José Martí</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('documentos') }}">Documentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('convocatorias') }}">Convocatorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('actividades')}}">Actividades</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('galeria') }}">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('directorio.index') }}">Directorio</a></li>
                </ul>
                <form method="POST" action="{{ route('buscador')}}" class="custom-search-form d-flex" role="search">
                    @csrf
                    <input name="keyword" class="form-control rounded-pill" type="search" autocomplete="off" placeholder="Buscar..." title="Escriba lo que quiere buscar">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="mb-0 p-1 bg-light"></div>

    <!-- Imagen Destacada -->
    <div class="card custom-card">
        <a class="navbar-brand" href="{{ route('home')}}">Cátedra José Martí</a>
        <div class="card-body">
            <a href="/">
                <img src="{{ asset('storage/catedra/martiheader_0.jpg') }}" alt="Cátedra José Martí" class="img-fluid w-100">
            </a>
        </div>
    </div>

    <!-- Contenido dinámico -->
<div class="container-fluid px-4">
    <div class="d-flex">

        <!-- Menú lateral derecho -->
    <div class="sidebar-menu">
        <h5 class="text-center">Menú</h5>
        <ul class="navbar-menu flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ Route('historia') }}">Historia</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('biografia')}}">José Martí</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('documentos') }}">Documentos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('convocatorias') }}">Convocatorias</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('actividades')}}">Actividades</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('galeria') }}">Galería</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ Route('directorio.index') }}">Directorio</a></li>
        </ul>
    </div> 
        <!-- Contenido dinámico -->
        <div class="flex-grow-1 px-3">
            @yield('content')
        </div>
    </div>
</div>



    @include('layouts.extensiones')

    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
