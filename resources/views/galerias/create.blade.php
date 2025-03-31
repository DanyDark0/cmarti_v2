<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear galería') }}
        </h2>
        <link rel="stylesheet" href="@sweetalert2/theme-material-ui/material-ui.css">
    </x-slot>
    <style>
        .swal-popup {
            @apply bg-white shadow-lg rounded-xl p-6; /* Fondo blanco con sombra y bordes redondeados */
        }

        .swal-title {
            @apply text-2xl font-bold text-gray-800; /* Texto grande y negrita */
        }

        .swal-text {
            @apply text-lg text-gray-600; /* Texto mediano y gris */
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
                timer: 3000,
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="convocatoriaForm" action="{{ route('galerias.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Campo para el Titulo  --}}
                        <div class="mb-4">
                            <label for="titulo" class="form-label">Título:</label>
                            <input id="titulo" name="titulo" class="form-control" required value="{{ old('titulo') }}" autocomplete="off">
                            @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                                <!-- Campo para la descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="url_imagen" class="block text-lg font-medium text-gray-700">Seleccionar imágenes:</label>
                        <input type="file" id="url_imagen" name="url_imagen[]" accept="image/*" multiple 
                            class="mt-2 p-2 border rounded-md w-full" required>
                    
                        <!-- Contenedor para mostrar las imágenes seleccionadas -->
                        <div id="preview" class="mt-4 flex flex-wrap gap-2"></div>

                        <input type="hidden" name="agregar_file" id="agregar_file" value="0">

                        <button 
                            type="button" 
                            id="submitButton"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow my-3 hover:bg-blue-600">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            var titulo = document.getElementById('titulo').value;
            var url_imagen = document.getElementById('url_imagen').value;

            if (!titulo || !url_imagen) {
                Swal.fire({
                    title: 'Espera...',
                    text: 'Por favor completa todos los campos requeridos',
                    icon: 'error',
                    position: 'top-end', // Coloca la alerta en la esquina superior derecha
                    showConfirmButton: false, // Oculta el botón de 'OK'
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: false, // No oscurece la pantalla
                    allowOutsideClick: true,
                    customClass: {
                        popup: 'swal-popup', 
                        title: 'swal-title', 
                        text: 'swal-text',
                    },
                });
                //Swal.fire('Error', 'Por favor completa todos los campos requeridos.', 'error');
                return; // Detiene el flujo si algún campo requerido está vacío
            }else{
                document.getElementById('convocatoriaForm').submit();
            }
        });
    </script>

<script>
    document.getElementById('url_imagen').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';  // Limpiar imágenes previas

        // Mostrar las imágenes seleccionadas
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md');
                preview.appendChild(imgElement);
            };
            reader.readAsDataURL(file);
        });
    });
    </script>

</x-app-layout>