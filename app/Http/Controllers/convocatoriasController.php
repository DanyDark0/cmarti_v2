<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convocatorias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;
use Illuminate\Validation\Rule;

class convocatoriasController extends Controller
{
    //
        public function getYears()
    {
        // Obtiene los años únicos de las fechas de las convocatorias
        $years = Convocatorias::selectRaw('YEAR(fecha) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');

        return view('welcome', compact('years'));
    }
    public function search_convocatoria(Request $request) {

        $mensajes = [
            'keyword.required' => 'Se requiere agregar un texto.',
            'keyword.string' => 'El dato a buscar debe ser un texto.',
            'keyword.min' => 'Su busqueda debe contener minimo 3 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|min:3',
        ],$mensajes);

        if ($validator->fails()) {
            return redirect()->route('convocatorias') // Cambia por la ruta de tu formulario
                ->withErrors($validator) // Enviar errores a la vista
                ->withInput();
        }

        $query = $request->input('keyword');

        $convocatorias = Convocatorias::search($query)->paginate(24);
        foreach ($convocatorias as $convocatoria) {
            $convocatoria->descripcion_truncado = $this->truncateHtml($convocatoria->descripcion, 100);
        }

        $totalResultados = $convocatorias->total();

        return view ("convocatorias.search" , compact('convocatorias', 'query', 'totalResultados'));
    }   

    function truncateHtml($html, $limit = 100)
    {
        $text = strip_tags($html); // Quita las etiquetas HTML
        $truncated = Str::limit($text, $limit); // Aplica el límite
        return $truncated;
    }

    public function index()
    {
        $convocatorias = Convocatorias::paginate(6);
        //return response()->json($convocatorias);
        foreach ($convocatorias as $convocatoria) {
            $convocatoria->descripcion_truncado = $this->truncateHtml($convocatoria->descripcion, 100);
        }

        return view('convocatorias.index', compact('convocatorias'));
    }

    public function admin()
    {
        $convocatorias = Convocatorias::paginate(10);
        foreach ($convocatorias as $convocatoria) {
            $convocatoria->descripcion_truncado = $this->truncateHtml($convocatoria->descripcion, 100);
        }
        return view('convocatorias.admin', compact('convocatorias'));
    }

    public function create()
    {
        return view('convocatorias.create');
    }

    public function store(Request $request)
    {
        $convocatoria = new Convocatorias();
        $validator = Validator::make($request->all(), [
            'titulo' => ['required','string','max:255',Rule::unique('convocatorias')->ignore($convocatoria->id), ],
            'descripcion' => 'required|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'fecha' => 'required|date',
        ], [
            'descripcion.required' => 'Agregue una descripcion.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser un texto válido.',
            'fecha.required' => 'Agrega una fecha.',
            'url_img1.image' => 'El archivo debe ser una imagen.',
            'url_img1.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'url_img1.max' => 'La imagen no debe superar los 2MB.',
            'url_img2.image' => 'El archivo debe ser una imagen.',
            'url_img2.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'url_img2.max' => 'La imagen no debe superar los 2MB.',
            'archivo1.file' => 'El archivo debe ser un documento.',
            'archivo1.mimes' => 'El archivo debe ser de tipo: pdf, doc o docx.',
            'archivo1.max' => 'El archivo no debe superar los 5MB.',
            'archivo2.file' => 'El archivo debe ser un documento.',
            'archivo2.mimes' => 'El archivo debe ser de tipo: pdf, doc o docx.',
            'archivo2.max' => 'El archivo no debe superar los 5MB.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $slug = Str::slug($request->titulo);
        $contador = 1;

        while (Convocatorias::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->titulo) . '-' . $contador;
            $contador++;
        }

        $convocatoria = new Convocatorias();
        $convocatoria->titulo = $request->titulo;
        $convocatoria->descripcion = $request->descripcion;
        $convocatoria->fecha = $request->fecha;

        if ($request->hasFile('url_img1')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen1' . '-' . now()->timestamp . '.' . $request->file('url_img1')->getClientOriginalExtension();
            $request->file('url_img1')->storeAs('convocatorias/image', $fileName, 'public'); // Guardar en storage/app/image
            $convocatoria->url_img1 = "storage/convocatorias/image/$fileName";
        }

        if ($request->hasFile('url_img2')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen2' . '-' . now()->timestamp . '.' . $request->file('url_img2')->getClientOriginalExtension();
            $request->file('url_img2')->storeAs('convocatorias/image', $fileName,'public');
            $convocatoria->url_img2 = "storage/convocatorias/image/$fileName";
        }

        // Guardar archivos con nombre original
        if ($request->hasFile('archivo1')) {
            $file = $request->file('archivo1');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('convocatorias/files', $fileName, 'public');
            $convocatoria->archivo1 = "storage/convocatorias/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            $file = $request->file('archivo2');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('convocatorias/files', $fileName, 'public');
            $convocatoria->archivo2 = "storage/convocatorias/files/$fileName";
        }

        //dd($request->all());
        $convocatoria->save();
        //return response()->json(['message' => 'convocatoria creada correctamente', 'convocatoria' => $convocatoria], 201);
        return redirect()->route('convocatorias.admin')->with('success', 'convocatoria creada correctamente');
    }

    public function edit($slug)
    {
        $convocatoria = Convocatorias::where('slug', $slug)->firstOrFail();
        return view('convocatorias.edit', compact('convocatoria'));
    }

    public function show($slug)
    {
        // Buscar la convocatoria por ID
        $convocatorias = Convocatorias::where('slug', $slug)->firstOrFail();
        // Retornar la vista con la convocatoria encontrada
        return view('convocatorias.show', compact('convocatorias'));
    }

    public function update(Request $request, $slug)
    {
        $convocatoria = Convocatorias::where('slug', $slug)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'titulo' => ['required','string','max:255',Rule::unique('convocatorias')->ignore($convocatoria->id), ],
            'descripcion' => 'required|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'fecha' => 'nullable|date',
        ], [
            'descripcion.required' => 'Agregue una descripcion.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser un texto válido.',
            'url_img1.image' => 'El archivo debe ser una imagen.',
            'url_img1.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'url_img1.max' => 'La imagen no debe superar los 2MB.',
            'url_img2.image' => 'El archivo debe ser una imagen.',
            'url_img2.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'url_img2.max' => 'La imagen no debe superar los 2MB.',
            'archivo1.file' => 'El archivo debe ser un documento.',
            'archivo1.mimes' => 'El archivo debe ser de tipo: pdf, doc o docx.',
            'archivo1.max' => 'El archivo no debe superar los 5MB.',
            'archivo2.file' => 'El archivo debe ser un documento.',
            'archivo2.mimes' => 'El archivo debe ser de tipo: pdf, doc o docx.',
            'archivo2.max' => 'El archivo no debe superar los 5MB.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $convocatoria->titulo = $request->titulo;
        $convocatoria->descripcion = $request->descripcion;
        $convocatoria->fecha = $request->fecha;

        // Actualizar imágenes
        if ($request->hasFile('url_img1')) {
            // Eliminar imagen anterior si existe
            if ($convocatoria->url_img1 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->url_img1)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->url_img1)));
            }
            $fileName = Str::slug($request->titulo) . '-imagen1-' . now()->timestamp . '.' . $request->file('url_img1')->getClientOriginalExtension();
            $request->file('url_img1')->storeAs('convocatorias/image', $fileName, 'public');
            $convocatoria->url_img1 = "storage/convocatorias/image/$fileName";
        }

        if ($request->hasFile('url_img2')) {
            if ($convocatoria->url_img2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->url_img2)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->url_img2)));
            }
            $fileName = Str::slug($request->titulo) . '-imagen2-' . now()->timestamp . '.' . $request->file('url_img2')->getClientOriginalExtension();
            $request->file('url_img2')->storeAs('convocatorias/image', $fileName, 'public');
            $convocatoria->url_img2 = "storage/convocatorias/image/$fileName";
        }

        // Actualizar archivos
        if ($request->hasFile('archivo1')) {
            if ($convocatoria->archivo1 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->archivo1)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->archivo1)));
            }
            $file = $request->file('archivo1');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('convocatorias/files', $fileName, 'public');
            $convocatoria->archivo1 = "storage/convocatorias/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            if ($convocatoria->archivo2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->archivo2)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $convocatoria->archivo2)));
            }
            $file = $request->file('archivo2');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('convocatorias/files', $fileName, 'public');
            $convocatoria->archivo2 = "storage/convocatorias/files/$fileName";
        }

        $convocatoria->save();

        return redirect()->route('convocatorias.admin')->with('success', 'convocatoria actualizada correctamente');
    }

    public function destroy($id) {

        $convocatoria = Convocatorias::findOrFail($id);
            // Eliminar archivos relacionados con la convocatoria, si existen
    if ($convocatoria->url_img1 && file_exists(public_path($convocatoria->url_img1))) {
        unlink(public_path($convocatoria->url_img1));  // Eliminar archivo de imagen 1
    }

    if ($convocatoria->url_img2 && file_exists(public_path($convocatoria->url_img2))) {
        unlink(public_path($convocatoria->url_img2));  // Eliminar archivo de imagen 2
    }

    if ($convocatoria->archivo1 && file_exists(public_path($convocatoria->archivo1))) {
        unlink(public_path($convocatoria->archivo1));  // Eliminar archivo 1
    }

    if ($convocatoria->archivo2 && file_exists(public_path($convocatoria->archivo2))) {
        unlink(public_path($convocatoria->archivo2));  // Eliminar archivo 2
    }
        $convocatoria->delete();
        return redirect()->route('convocatorias.admin')->with('success', 'convocatoria eliminada correctamente');
    }
        // Eliminar imagen
        public function eliminarArchivo($slug, $campo)
        {
            $convocatoria = Convocatorias::where('slug', $slug)->firstOrFail();
        
            // Verificar si el campo es válido
            if (!in_array($campo, ['url_img1', 'url_img2', 'archivo1', 'archivo2'])) {
                return response()->json(['success' => false, 'message' => 'Campo inválido.']);
            }
        
            // Verificar si el archivo existe
            if ($convocatoria->$campo) {
                $rutaArchivo = public_path($convocatoria->$campo);
                
                // Eliminar el archivo del servidor
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
        
                // Eliminar referencia en la base de datos
                $convocatoria->$campo = null;
                $convocatoria->save();
        
                return response()->json(['success' => true, 'message' => 'Archivo eliminado correctamente.']);
            }
        
            return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
        }
}
