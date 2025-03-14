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
                            <div class="mt-auto flex gap-2 pt-3">
                                <a href="{{ route('editar_Galeria', ['id' => $galeria->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-full hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>                                      
                                </a>                           
                                <form action="{{ route('galerias.delete', $galeria->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-full hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>                                          
                                    </button>
                                </form>
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
    <div class="fixed bottom-4 right-4">
        <a href="{{ route('crear_Galeria') }}" id="btn_agregar" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 overflow-hidden">
            <span id="btn_icono" class="transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </span>
            <span id="btn_texto" style="user-select: none" class="text-content hidden ml-2">Agregar</span>
        </a>
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
