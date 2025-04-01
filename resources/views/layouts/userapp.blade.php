<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cátedra José Martí')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet" />
    <style>

/* Ajustes del contenedor principal */
.d-flex {
    align-items: flex-start; /* Alinea contenido y menú en la parte superior */
}
/* Cuando el menú está activo */
.sidebar-menu.active {
    left: 0;
}
.menu-toggle {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    background-color: #752e0f;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 24px;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1000;
}
/* Estilos del menú lateral */
.sidebar-menu {
    color: #752e0f;
    position: sticky;
    top: 80px; /* Ajusta según la altura del navbar */
    height: 100vh; /* Hace que el menú abarque toda la altura de la pantalla */
    overflow-y: auto; /* Permite desplazamiento si el contenido es grande */
    width: 200px; /* Fija el ancho del menú */
    flex-shrink: 0; /* Evita que el menú se reduzca en pantallas pequeñas */
    border-right: 5px solid #752e0f; /* Borde derecho café */
    border-radius: 10px;
    padding: 20px; /* Espaciado interno */
    display: flex;
    flex-direction: column;
    transition: left 0.3s ease-in-out;
}

.sidebar-menu ul {
    list-style: none; /* Elimina los puntos de la lista */
    padding: 0;
    margin: 0;
}

.sidebar-menu ul li {
    font-size: 18px; /* Aumenta el tamaño de la letra */
    padding: 16px 0; /* Agrega espacio arriba y abajo de cada elemento */
    letter-spacing: 1px; /* Aumenta el espacio entre las letras */
    line-height: 1.2; /* Aumenta el espacio entre líneas */
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

.custom-card-banner {
    background-color: #e6b168;
    margin: 20px; /* Márgenes externos */
    border-radius: 20px; /* Bordes redondeados */
    border: none;
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
.nav-img {
    font-size: 1.5rem; 
    padding-left: 1rem;
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
    border-color: #e94702;
}

/* Estilo general del botón toggler */
.custom-toggler {
    border: none; /* Sin borde */
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
    background-image: none !important;
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
    /* Mostrar botón hamburguesa */
    .menu-toggle {
        display: block;
    }

    /* Ocultar menú lateral y hacerlo flotante */
    .sidebar-menu {
        left: -250px; /* Oculto fuera de la pantalla */
        position: fixed;
        top: 0;
        width: 250px;
        height: 100vh;
        background-color: white;
        z-index: 999;
    }

    /* Clase que se activa cuando el menú está visible */
    .sidebar-menu.active {
        left: 0;
    }
}

    </style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl navbar-custom">
        <div class="container-fluid">
            <div class="navbar-brand mx-auto d-xl">
                <a href="{{ route('welcome')}}">
                    <img src="{{ asset('./catedra/Jose-Marti.jpg') }}" alt="logo Jose Marti" class="navbar-logo">
                </a>
            </div>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('galeria') }}">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('directorio.index') }}">Directorio</a></li>
                </ul>
                <form method="GET" action="{{ route('buscador')}}" class="custom-search-form d-flex" role="search">
                    @csrf
                    <input name="keyword" id="keyword" class="form-control rounded-pill" type="search" autocomplete="off" placeholder="Buscar...">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="mb-0 p-1 bg-light"></div>

    <!-- Imagen Destacada -->
    <div class="card custom-card-banner">
        <a class="navbar-brand nav-img font-weight-bold text-left">Cátedra José Martí</a>
        <div>
            <a href="{{ route('welcome')}}">
                <img src="{{ asset('./catedra/martiheader_0.jpg') }}" alt="Cátedra José Martí" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;" class="img-fluid-banner w-100">
            </a>
        </div>
    </div>

    <!-- Contenido dinámico -->
<div class="container-fluid">
    <div class="d-flex gap-3">
                <!-- Botón de menú hamburguesa -->
        <button id="menu-toggle" class="menu-toggle">
            ☰
        </button>
        <!-- Menú lateral derecho -->
    <div class="sidebar-menu" id="sidebar">
        <h5 class="text-center">Menú</h5>
        <ul class="navbar-menu flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ Route('welcome') }}">Inicio</a></li>
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
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>
</div>



    @include('layouts.extensiones')

    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let menuToggle = document.getElementById("menu-toggle");
            let sidebar = document.getElementById("sidebar");
        
            menuToggle.addEventListener("click", function () {
                sidebar.classList.toggle("active");
            });
        });
        </script>
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
    <script src="{{ asset('vendor/lightbox2/dist/js/lightbox-plus-jquery.js') }}"></script>
</body>
</html>
