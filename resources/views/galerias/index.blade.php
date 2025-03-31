<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galería') }}
        </h2>
        <link href="{{ asset('vendor/lightbox2-2.11.5/dist/css/lightbox.min.css') }}" rel="stylesheet" />
        <style>
            .carousel {
                position: relative;
                width: 100%;
                height: 200px;
                overflow: hidden;
            }
            .carousel img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: none;
            }
            .carousel img.active {
                display: block;
            }
            .carousel button {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
            }
            .carousel .prev {
                left: 10px;
            }
            .carousel .next {
                right: 10px;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Formulario de buscador exclusivo de actividades --}}
                <div class="flex justify-end items-center m-4">
                    <form action="{{ route('galerias.buscar_admin') }}" method="POST" class="flex mb-4">
                        @csrf
                        <input type="text" name="keyword" value="{{ $query ?? '' }}" placeholder="Buscar galeria..." class="form-input w-60 sm:w-96 p-2 border border-gray-300 rounded-md mr-2">
                        <button type="submit" class="bg-gray-400 hover:text-white text-dark px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none">
                            Buscar
                        </button>
                    </form>
                </div>
            <!-- Botón para agregar nuevo -->
            <a href="{{ route('crear_Galeria') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded m-4 inline-block">
                <button>Agregar Nueva Galería</button>
            </a>
            
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                    @forelse($galerias as $galeria)
                        <div class="max-w-sm h-[350px] min-h-[350px] p-6 bg-white border border-gray-200 rounded-lg shadow-sm flex flex-col justify-between">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 truncate min-h-[48px]">
                                {{ Str::limit($galeria->titulo, 50, '...') }}
                            </h5>
                            <div class="carousel">
                                @foreach($galeria->fotos as $index => $foto)
                                    <img src="{{ asset('storage/galeria/'.$foto->url_imagen) }}" class="{{ $index == 0 ? 'active' : '' }}">
                                @endforeach
                                <button class="prev">&#10094;</button>
                                <button class="next">&#10095;</button>
                            </div>
                            <div class="mt-auto flex gap-4 pt-3">
                                <a href="{{ route('editar_Galeria', ['id' => $galeria->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 no-underline">
                                    Editar
                                </a>
                                @can('Eliminar galerias')                        
                                <form action="{{ route('galerias.delete', $galeria->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-full hover:bg-red-700">
                                        Borrar
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center">
                            <p class="text-gray-500">No se encontraron galerías.</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $galerias->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".carousel").forEach(carousel => {
                let images = carousel.querySelectorAll("img");
                let currentIndex = 0;

                function showImage(index) {
                    images.forEach(img => img.classList.remove("active"));
                    images[index].classList.add("active");
                }

                carousel.querySelector(".prev").addEventListener("click", function() {
                    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
                    showImage(currentIndex);
                });

                carousel.querySelector(".next").addEventListener("click", function() {
                    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
                    showImage(currentIndex);
                });
            });
        });
    </script>
</x-app-layout>
