<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\Fotos;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    public function BuscadorAdminGaleria(Request $request) {
        $mensajes = [
            'keyword.required' => 'Se requiere agregar un texto.',
            'keyword.string' => 'El dato a buscar debe ser un texto.',
            'keyword.min' => 'Su busqueda debe contener minimo 3 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|min:3',
        ],$mensajes);

        if ($validator->fails()) {
            return redirect()->route('galerias.auth') // Cambia por la ruta de tu formulario
                ->withErrors($validator) // Enviar errores a la vista
                ->withInput();
        }

            // Obtener el término de búsqueda
            $query = $request->input('keyword');
        // Realizar la búsqueda con Scout
        $galerias = Galeria::search($query)->paginate(6);

        $totalResultados = $galerias->total();
            // Devolver los resultados a la vista, junto con el término de búsqueda
            return view('galerias.resultados_admin', [
                'galerias' => $galerias,
                'query' => $query, // Pasar el término de búsqueda para mostrarlo en el input
                'totalResultados' => $totalResultados
            ]);
    }
    //
    public function index()
    {
        //$actividades = actividades::all();
        $galerias = Galeria::with('fotos')->orderBy('created_at', 'desc')->paginate(3);

        return view("galerias.carusel", compact('galerias'));
        /* return response()->json([
            'success' => true,
            'data' => $galeria,
            'message' => 'Galerias encontradas exitosamente',
        ], 201); */
    }

    public function index_logeado()
    {
        $galerias = Galeria::with('fotos')->orderBy('created_at', 'desc')->paginate(24);

        return view("galerias.index", compact('galerias'));
    }

    public function create()
    {
        return view("galerias.create");
    }

    public function store(Request $request)
    {
        $mensajes = [
            'titulo.required' => 'El titulo es obligatorio.',
            'titulo.max' => 'El titulo de la galeria no debe sobrepasar los 255 caracteres.',
            'descripcion.max' => 'La descripcion no debe ser mayor a 250 caráteres',

            'url_imagen.required' => 'Debe adjuntar al menos un imagen.',

            'url_imagen.*.file' => 'Cada imagen debe ser un url_imagen válido.',
            'url_imagen.*.mimes' => 'Solo se permiten imagen en formato: jpeg, png, jpg o pdf.',
        ];

            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string|max:200',
                'descripcion' => 'nullable|string|max:250',
                'url_imagen' => ['required'],
                'url_imagen.*' => [
                    'file',
                    function ($attribute, $file, $fail) {
                        $maxSize = ($file->getClientOriginalExtension() === 'pdf') ? 5120 : 12288; // 5MB para PDF, 12MB para imágenes
                        if ($file->getSize() > $maxSize * 1024) {
                            return $fail("La imagen {$file->getClientOriginalName()} excede el tamaño permitido.");
                        }
                    },
                    'mimes:jpeg,png,jpg,pdf'
                ],
            ], $mensajes);

            if ($validator->fails()) {
                return redirect()->route('crear_Galeria') // Cambia por la ruta de tu formulario
                    ->withErrors($validator) // Enviar errores a la vista
                    ->withInput();
            }

        try {

            $galeria = new Galeria();

            $galeria->titulo = $request->titulo;
            $galeria->descripcion = $request->descripcion;

            $galeria->save();

            $archivosGuardados = [];

            if ($request->hasFile('url_imagen')) {
                foreach ($request->file('url_imagen') as $url_imagen) {
                    $extension = $url_imagen->getClientOriginalExtension();
                    $nombreArchivo = 'url_imagen_' . uniqid() . '.' . $extension;
                    //$ruta = public_path('img/galeria/');
                    // $ruta = Storage::disk('public')->path('store/galeria/');
                    // $url_imagen->move($ruta, $nombreArchivo);
                    $ruta = $url_imagen->storeAs('galeria', $nombreArchivo, 'public'); // Guarda en storage/app/public/galeria

                    $documentacion = new Fotos();
                    $documentacion->galeria_id = $galeria->id;
                    $documentacion->url_imagen = $nombreArchivo;
                    $documentacion->save();

                    $archivosGuardados[] = $documentacion;
                }
            }

            $script = "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: '¡Se ha creado la galeria correctamente!',
                icon: 'success',
                position: 'top-end', // Coloca la alerta en la esquina superior derecha
                showConfirmButton: false, // Oculta el botón de 'OK'
                timer: 1000, // Desaparece en 1 segundo
                timerProgressBar: true,
                backdrop: false, // No oscurece la pantalla
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal-popup', 
                    title: 'swal-title', 
                    text: 'swal-text',
                },
            }).then(() => {
            history.replaceState({}, document.title, window.location.pathname); // Limpiar el mensaje de la URL
            setTimeout(() => {
                // Borrar el mensaje flash después de la alerta
                window.location.reload(); // Recargar la página para que se borre la sesión correctamente
            }, 1200); // 1.2 segundos después de mostrar el mensaje
        });
    </script>";

        // Pasar el script a la vista
        return redirect()->route('galerias.auth')->with('script', $script);

        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al crear la Galeria',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(string $id)
    {
        $galeria = Galeria::findOrFail($id);
        $documentos_galeria = Fotos::where('galeria_id', $id)->get();

        return view("galerias.edit", compact('galeria','documentos_galeria'));
    }

    public function update(Request $request, $id)
    {
        $mensajes = [
            'titulo.required' => 'El titulo es obligatorio.',
            'titulo.max' => 'El titulo de la galeria no debe sobrepasar los 255 caracetres.',
            'descripcion.max' => 'La descripcion no debe ser mayor a 250 caráteres',

            'url_imagen.required' => 'Debe adjuntar al menos un imagen.',

            'url_imagen.*.file' => 'Cada imagen debe ser un imagen válido.',
            'url_imagen.*.mimes' => 'Solo se permiten imagen en formato: jpeg, png, jpg o pdf.',
        ];

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:250',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect()->route('editar_Galeria', ['id' => $id]) // Cambia por la ruta de tu formulario
                ->withErrors($validator) // Enviar errores a la vista
                ->withInput();
        }

        try {
            $galeria = Galeria::find($id);

            if (!$galeria) {
                return response()->json(['message' => 'Galeria no encontrada'], 404);
            }

            $galeria->titulo = $request->titulo;
            $galeria->descripcion = $request->descripcion;

            $galeria->save();

            $script = "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: '¡Se ha actualizado el titulo de la galeria correctamente!',
                icon: 'success',
                position: 'top-end', // Coloca la alerta en la esquina superior derecha
                showConfirmButton: false, // Oculta el botón de 'OK'
                timer: 1000, // Desaparece en 1 segundo
                timerProgressBar: true,
                backdrop: false, // No oscurece la pantalla
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal-popup', 
                    title: 'swal-title', 
                    text: 'swal-text',
                },
            }).then(() => {
            history.replaceState({}, document.title, window.location.pathname); // Limpiar el mensaje de la URL
            setTimeout(() => {
                // Borrar el mensaje flash después de la alerta
                window.location.reload(); // Recargar la página para que se borre la sesión correctamente
            }, 1200); // 1.2 segundos después de mostrar el mensaje
        });
    </script>";

        // Pasar el script a la vista
        return redirect()->route('galerias.auth')->with('script', $script);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar la galeria',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $galeria = Galeria::find($id);

            if (!$galeria) {
                return response()->json(['message' => 'Galeria no encontrada'], 404);
            }

            $galeria->delete();

            $script = "<script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: '¡Se ha eliminado correctamente la galeria!',
                    icon: 'success',
                    position: 'top-end', // Coloca la alerta en la esquina superior derecha
                    showConfirmButton: false, // Oculta el botón de 'OK'
                    timer: 1000, // Desaparece en 1 segundo
                    timerProgressBar: true,
                    backdrop: false, // No oscurece la pantalla
                    allowOutsideClick: true,
                    customClass: {
                        popup: 'swal-popup', 
                        title: 'swal-title', 
                        text: 'swal-text',
                    },
                }).then(() => {
                history.replaceState({}, document.title, window.location.pathname); // Limpiar el mensaje de la URL
                setTimeout(() => {
                    // Borrar el mensaje flash después de la alerta
                    window.location.reload(); // Recargar la página para que se borre la sesión correctamente
                }, 1200); // 1.2 segundos después de mostrar el mensaje
            });
        </script>";

            // Pasar el script a la vista
            return redirect()->route('galerias.auth')->with('script', $script);
        } catch (\Exception $e) {
            // Manejo de errores
            $script = "<script>
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error al eliminar la galeria',
                icon: 'error',
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                backdrop: false,
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal-popup', 
                    title: 'swal-title', 
                    text: 'swal-text',
                },
            }).then(() => {
                history.replaceState({}, document.title, window.location.pathname); // Limpiar el mensaje de la URL
                setTimeout(() => {
                    // Borrar el mensaje flash después de la alerta
                    window.location.reload(); // Recargar la página para que se borre la sesión correctamente
                }, 1200); // 1.2 segundos después de mostrar el mensaje
            });
        </script>";

        // Pasar el script a la vista
        return redirect()->route('galerias.auth')->with('script', $script);
        }
        
    }

}
