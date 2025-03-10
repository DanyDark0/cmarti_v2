<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class actividadesController extends Controller
{

    public function search_actividad(Request $request) {

        $query = $request->input('keyword');

        $actividades = Actividad::search($query)->paginate(24);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }

        return view ("actividades" , compact('actividades', 'query'));
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'required|date',
            'noticia' => 'nullable|boolean',
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
            $file = $request->file('archivo1');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo1 = "storage/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            $file = $request->file('archivo2');
            $fileName = $file->getClientOriginalName();
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
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'required|date',
            'noticia' => 'nullable|boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $actividad = Actividad::where('slug', $slug)->firstOrFail();

        if ($request->titulo !== $actividad->titulo) {
            $nuevoSlug = Str::slug($request->titulo);
            $contador = 1;
    
            // Asegurar que el slug sea único
            while (Actividad::where('slug', $nuevoSlug)->where('id', '!=', $actividad->id)->exists()) {
                $nuevoSlug = Str::slug($request->titulo) . '-' . $contador;
                $contador++;
            }
    
            $actividad->slug = $nuevoSlug;
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
            $fileName = $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo1 = "storage/files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            if ($actividad->archivo2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo2)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $actividad->archivo2)));
            }

            $file = $request->file('archivo2');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');
            $actividad->archivo2 = "storage/files/$fileName";
        }

        $actividad->save();

        return redirect()->route('actividades.admin')->with('success', 'Actividad actualizada correctamente');
    }

    public function destroy($slug)
    {
        $actividad = Actividad::where('slug', $slug)->firstOrFail();
        $actividad->delete();
        return redirect()->route('actividades.admin')->with('success', 'Actividad eliminada correctamente');
    }
}
