<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class actividadesController extends Controller
{
        public function getYears()
    {
        // Obtiene los años únicos de las fechas de las actividades
        $years = Actividad::selectRaw('YEAR(fecha) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');

        return view('welcome', compact('years'));
    }

    public function search_actividad(Request $request) {

        $mensajes = [
            'keyword.required' => 'Se requiere agregar un texto.',
            'keyword.string' => 'El dato a buscar debe ser un texto.',
            'keyword.min' => 'Su busqueda debe contener minimo 3 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|min:3',
        ],$mensajes);

        if ($validator->fails()) {
            return redirect()->route('actividades') // Cambia por la ruta de tu formulario
                ->withErrors($validator) // Enviar errores a la vista
                ->withInput();
        }

        // Obtener el término de búsqueda
        $query = $request->input('keyword');

        // Realizar la búsqueda con Scout
        $actividades = Actividad::search($query)->paginate(6);

        foreach ($actividades as $actividad) {
            $actividad->cuerpo_truncado = $this->truncateHtml($actividad->cuerpo, 100);
        }

        $totalResultados = $actividades->total();

        return view("actividades.search", compact('actividades', 'query', 'totalResultados'));
    }

    function truncateHtml($html, $limit = 100)
    {
        $text = strip_tags($html); // Quita las etiquetas HTML
        $truncated = Str::limit($text, $limit); // Aplica el límite
        return $truncated;
    }

    public function admin()
    {
        $actividades = Actividad::paginate(10);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }
        return view('actividades.admin', compact('actividades'));
    }
    public function index()
    {
        $actividades = Actividad::paginate(6);
        //return response()->json($actividades);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }
        return view('actividades.index', compact('actividades'));
    }

    public function create()
    {
        return view('actividades.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 
                        'string',
                        'max:255',
                            Rule::unique('actividades')->whereNull('deleted_at')
                        ],
            'descripcion' => 'required|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'required|date',
            'noticia' => 'nullable|boolean',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.unique' => 'El título ya está en uso. Prueba con otro.',
            'descripcion.required' => 'Agregue una descripción.',
            'fecha.required' => 'La fecha es requerida',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generar slug único
        $slug = Str::slug($request->titulo);
        $contador = 1;

        // Verificar si el slug ya existe y modificarlo si es necesario
        while (Actividad::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->titulo) . '-' . $contador;
            $contador++;
        }

        $actividad = new Actividad();
        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha = $request->fecha;
        $actividad->noticia = $request->has('noticia');
        $actividad->save();

        if ($request->hasFile('url_img1')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen1' . '-' . now()->timestamp . '.' . $request->file('url_img1')->getClientOriginalExtension();
            $request->file('url_img1')->storeAs('image', $fileName, 'public'); // Guardar en storage/app/image
            $actividad->url_img1 = "storage/image/$fileName";
        }

        if ($request->hasFile('url_img2')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen2' . '-' . now()->timestamp . '.' . $request->file('url_img2')->getClientOriginalExtension();
            $request->file('url_img2')->storeAs('image', $fileName,'public');
            $actividad->url_img2 = "storage/image/$fileName";
        }

        // Guardar archivos con nombre original
        if ($request->hasFile('archivo1')) {
            $file =  $request->file('archivo1');
            $fileName = $actividad->id . '_' . $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo1 = "storage/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            $file = $request->file('archivo2');
            $fileName = $actividad->id . '_' . $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo2 = "storage/files/$fileName";
        }

        //dd($request->all());
        $actividad->save();
        //return response()->json(['message' => 'Actividad creada correctamente', 'actividad' => $actividad], 201);
        return redirect()->route('actividades.admin')->with('success', 'Actividad creada correctamente');
    }

    public function edit($slug)
    {
        $actividad = Actividad::where('slug', $slug)->firstOrFail();
        return view('actividades.edit', compact('actividad'));
    }
    public function show($slug)
    {
        // Buscar la actividad por ID
        $actividad = Actividad::where('slug', $slug)->firstOrFail();

        // Retornar la vista con la actividad encontrada
        return view('actividades.show', compact('actividad'));
    }

    public function update(Request $request, $slug)
    {
        $actividad = Actividad::where('slug', $slug)->firstOrFail();
        
        $validator = Validator::make($request->all(), [
            'titulo' => ['required','string','max:255',Rule::unique('actividades')->ignore($actividad->id)->whereNull('deleted_at'), ],
            'descripcion' => 'nullable|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'required|date',
            'noticia' => 'nullable|boolean',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.unique' => 'El título ya está en uso. Prueba con otro.',
            'descripcion.required' => 'Agregue una descripción.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha = $request->fecha;
        $actividad->noticia = $request->has('noticia'); // Guarda como true o false

        // Actualizar imágenes
        if ($request->hasFile('url_img1')) {
            // Eliminar la imagen anterior si existe
            if ($actividad->url_img1 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $actividad->url_img1)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $actividad->url_img1)));
            }

            // Subir nueva imagen
            $fileName = Str::slug($request->titulo) . '-imagen1-' . now()->timestamp . '.' . $request->file('url_img1')->getClientOriginalExtension();
            $request->file('url_img1')->storeAs('image', $fileName, 'public');
            $actividad->url_img1 = "storage/image/$fileName";
        }

        if ($request->hasFile('url_img2')) {
            if ($actividad->url_img2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $actividad->url_img2)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $actividad->url_img2)));
            }

            $fileName = Str::slug($request->titulo) . '-imagen2-' . now()->timestamp . '.' . $request->file('url_img2')->getClientOriginalExtension();
            $request->file('url_img2')->storeAs('image', $fileName, 'public');
            $actividad->url_img2 = "storage/image/$fileName";
        }

        // Actualizar archivos
        if ($request->hasFile('archivo1')) {
            if ($actividad->archivo1 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo1)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo1)));
            }

            $file = $request->file('archivo1');
            $fileName = $actividad->id . '_' . $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo1 = "storage/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            if ($actividad->archivo2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo2)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo2)));
            }

            $file = $request->file('archivo2');
            $fileName = $actividad->id . '_' . $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo2 = "storage/files/$fileName";
        }

        $actividad->save();

        return redirect()->route('actividades.admin')->with('success', 'Actividad actualizada correctamente');
    }

    public function destroy($slug)
    {
        $actividad = Actividad::where('slug', $slug)->firstOrFail();
        $campos = ['url_img1', 'url_img2', 'archivo1', 'archivo2'];
        foreach ($campos as $campo) {
            if(!empty($actividad->$campo)){
                $rutaArchivo = public_path($actividad->$campo);
                if(file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            }
        }
        $actividad->delete();
        return redirect()->route('actividades.admin')->with('success', 'Actividad eliminada correctamente');
    }
    public function eliminarArchivo($slug, $campo)
    {
        $actividad = Actividad::where('slug', $slug)->first();
        
        if (!$actividad) {
            return response()->json(['error' => 'Actividad no encontrada'], 404);
        }

        // Verificar si el campo es válido
        if (!in_array($campo, ['url_img1', 'url_img2', 'archivo1', 'archivo2'])) {
            return response()->json(['error' => 'Campo inválido.'], 400);
        }
    
        // Verificar si el archivo existe
            $rutaArchivo = public_path($actividad->$campo);
            
            // Eliminar el archivo del servidor
            if ($rutaArchivo && file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
        
            // Eliminar referencia en la base de datos
            $actividad->$campo = null;
            $actividad->save();
    
            return response()->json(['success' => true, 'message' => 'Archivo eliminado correctamente.']);
        }
    
        return response()->json(['success' => false, 'message' => 'Archivo no encontrado.'], 404);
    }
}
